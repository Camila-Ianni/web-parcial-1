<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $paidOrders = Order::query()->where('status', 'paid')->get();
        $totalRevenue = $paidOrders->sum('total_price');

        $items = OrderItem::query()
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'paid')
            ->select('order_items.product_id', 'order_items.quantity')
            ->get();

        $productQuantities = [];
        foreach ($items as $item) {
            if (!isset($productQuantities[$item->product_id])) {
                $productQuantities[$item->product_id] = 0;
            }
            $productQuantities[$item->product_id] += $item->quantity;
        }

        arsort($productQuantities);
        $bestProductId = !empty($productQuantities) ? array_key_first($productQuantities) : null;
        $bestProduct = $bestProductId ? Product::find($bestProductId) : null;
        $bestSellerName = $bestProduct ? $bestProduct->name : 'N/A';
        $bestSellerQty = $bestProductId ? $productQuantities[$bestProductId] : 0;

        $monthlyRevenue = [];
        foreach ($paidOrders as $order) {
            $monthName = $order->created_at->translatedFormat('F Y');
            if (!isset($monthlyRevenue[$monthName])) {
                $monthlyRevenue[$monthName] = 0.0;
            }
            $monthlyRevenue[$monthName] += (float) $order->total_price;
        }

        arsort($monthlyRevenue);
        $bestMonth = !empty($monthlyRevenue) ? array_key_first($monthlyRevenue) : 'N/A';
        $bestMonthRevenue = !empty($monthlyRevenue) ? $monthlyRevenue[$bestMonth] : 0.0;

        $products = Product::query()->get();
        $productStats = [];
        foreach ($products as $prod) {
            $unitsSold = OrderItem::query()
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.status', 'paid')
                ->where('order_items.product_id', $prod->id)
                ->sum('order_items.quantity');
                
            $revenueGenerated = OrderItem::query()
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.status', 'paid')
                ->where('order_items.product_id', $prod->id)
                ->selectRaw('SUM(order_items.quantity * order_items.price) as total')
                ->value('total') ?? 0.0;
                
            $productStats[] = [
                'name' => $prod->name,
                'image' => $prod->image_path,
                'price' => $prod->price,
                'sold' => (int) $unitsSold,
                'revenue' => (float) $revenueGenerated,
            ];
        }

        usort($productStats, function ($a, $b) {
            return $b['sold'] <=> $a['sold'];
        });

        return view('admin.dashboard', [
            'postsCount' => Post::query()->count(),
            'productsCount' => Product::query()->count(),
            'usersCount' => User::query()->count(),
            'totalRevenue' => $totalRevenue,
            'bestSellerName' => $bestSellerName,
            'bestSellerQty' => $bestSellerQty,
            'bestMonth' => ucfirst($bestMonth),
            'bestMonthRevenue' => $bestMonthRevenue,
            'productStats' => $productStats,
        ]);
    }
}
