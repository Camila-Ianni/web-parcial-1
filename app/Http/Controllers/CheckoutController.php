<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class CheckoutController extends Controller
{
    public function index(CartService $cartService)
    {
        $summary = $cartService->summary();

        if (empty($summary['items'])) {
            return redirect()->route('products.index')
                ->withErrors(['cart' => 'Tu carrito está vacío. Agrega prendas para iniciar la compra.']);
        }

        return view('checkout.index', [
            'summary' => $summary,
        ]);
    }

    public function store(Request $request, CartService $cartService): RedirectResponse
    {
        $summary = $cartService->summary();

        if (empty($summary['items'])) {
            return redirect()->route('products.index')
                ->withErrors(['cart' => 'Tu carrito está vacío.']);
        }

        $request->validate([
            'shipping_address' => ['required', 'string', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:50'],
        ], [
            'shipping_address.required' => 'La dirección de envío es obligatoria.',
            'contact_phone.required' => 'El teléfono de contacto es obligatorio.',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total_price' => $summary['total'],
            'shipping_address' => $request->input('shipping_address'),
            'contact_phone' => $request->input('contact_phone'),
        ]);

        foreach ($summary['items'] as $item) {
            $product = Product::query()->where('slug', $item['sku'])->first();
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
        }

        $mpItems = [];
        foreach ($summary['items'] as $item) {
            $mpItems[] = [
                'id' => $item['sku'],
                'title' => $item['name'],
                'quantity' => (int) $item['quantity'],
                'unit_price' => (float) $item['price'],
                'currency_id' => 'ARS',
            ];
        }

        try {
            $accessToken = env('MERCADOPAGO_ACCESS_TOKEN', 'APP_USR-6523910375171787-071120-7f28e2ad3b1e32d56a29267ffea49d0d-210134950');
            MercadoPagoConfig::setAccessToken($accessToken);

            $client = new PreferenceClient();
            $preference = $client->create([
                "items" => $mpItems,
                "back_urls" => [
                    "success" => route('checkout.success', ['order' => $order->id]),
                    "failure" => route('checkout.failure', ['order' => $order->id]),
                    "pending" => route('checkout.pending', ['order' => $order->id]),
                ],
                "auto_return" => "approved",
                "external_reference" => (string) $order->id,
            ]);

            $order->payment_id = $preference->id;
            $order->save();

            $redirectUrl = $preference->sandbox_init_point ?: $preference->init_point;
            return redirect($redirectUrl);

        } catch (\Exception $e) {
            return redirect()->route('checkout.success', [
                'order' => $order->id,
                'fallback' => 'true'
            ]);
        }
    }

    public function success(Request $request, Order $order, CartService $cartService): View
    {
        $order->update([
            'status' => 'paid',
            'payment_id' => $order->payment_id ?: $request->input('payment_id')
        ]);

        $cartService->clear();

        return view('checkout.success', [
            'order' => $order,
            'isFallback' => $request->has('fallback'),
        ]);
    }

    public function failure(Request $request, Order $order): View
    {
        $order->update([
            'status' => 'failed'
        ]);

        return view('checkout.failure', [
            'order' => $order,
        ]);
    }

    public function pending(Request $request, Order $order, CartService $cartService): View
    {
        $cartService->clear();

        return view('checkout.pending', [
            'order' => $order,
        ]);
    }
}
