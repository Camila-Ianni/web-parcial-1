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

/**
 * Class DashboardController
 *
 * Handles rendering the administrative dashboard home screen with business stats.
 *
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
    /**
     * Handle the incoming request to view the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        // 1. Paid orders
        $paidOrders = Order::query()->where('status', 'paid')->get();
        $totalRevenue = $paidOrders->sum('total_price');

        // 2. Best selling product calculated in PHP for database compatibility
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

        // 3. Month with highest billing
        $monthlyRevenue = [];
        foreach ($paidOrders as $order) {
            $monthName = $order->created_at->translatedFormat('F Y'); // e.g. "julio 2026"
            if (!isset($monthlyRevenue[$monthName])) {
                $monthlyRevenue[$monthName] = 0.0;
            }
            $monthlyRevenue[$monthName] += (float) $order->total_price;
        }

        arsort($monthlyRevenue);
        $bestMonth = !empty($monthlyRevenue) ? array_key_first($monthlyRevenue) : 'N/A';
        $bestMonthRevenue = !empty($monthlyRevenue) ? $monthlyRevenue[$bestMonth] : 0.0;

        return view('admin.dashboard', [
            'postsCount' => Post::query()->count(),
            'productsCount' => Product::query()->count(),
            'usersCount' => User::query()->count(),
            'totalRevenue' => $totalRevenue,
            'bestSellerName' => $bestSellerName,
            'bestSellerQty' => $bestSellerQty,
            'bestMonth' => ucfirst($bestMonth),
            'bestMonthRevenue' => $bestMonthRevenue,
        ]);
    }
}
