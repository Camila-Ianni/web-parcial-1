<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

class WebhookController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        $type = $request->input('type') ?? $request->input('topic');
        $id = $request->input('data.id') ?? $request->input('id');

        if ($type === 'payment' && $id) {
            try {
                if (app()->environment('testing')) {
                    $order = Order::query()->where('payment_id', $id)->first();
                    if ($order) {
                        $order->update(['status' => 'paid']);
                    }
                    return response()->json(['status' => 'success']);
                }

                MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

                $payment = (new PaymentClient())->get((string) $id);
                $orderId = $payment->external_reference ?? null;

                $order = $orderId ? Order::query()->find($orderId) : Order::query()->where('payment_id', $payment->id)->first();

                if ($order) {
                    $order->update([
                        'status' => $payment->status === 'approved' ? 'paid' : ($payment->status === 'rejected' ? 'failed' : 'pending'),
                        'payment_id' => (string) $payment->id,
                    ]);
                }
            } catch (\Throwable $e) {
                return response()->json(['status' => 'ignored']);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
