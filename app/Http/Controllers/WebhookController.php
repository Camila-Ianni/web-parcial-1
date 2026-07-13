<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WebhookController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        $type = $request->input('type') ?? $request->input('topic');
        $id = $request->input('data.id') ?? $request->input('id');

        if ($type === 'payment' && $id) {
            $order = Order::query()->where('payment_id', $id)->first();
            if ($order) {
                $order->update(['status' => 'paid']);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
