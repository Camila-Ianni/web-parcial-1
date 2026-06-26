<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function summary(CartService $cartService): JsonResponse
    {
        return response()->json($cartService->summary());
    }

    public function add(Request $request, CartService $cartService): JsonResponse
    {
        $data = $request->validate([
            'sku' => ['required', 'string', 'max:120'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:500'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
        ]);

        return response()->json($cartService->add($data));
    }

    public function remove(Request $request, CartService $cartService): JsonResponse
    {
        $data = $request->validate([
            'sku' => ['required', 'string', 'max:120'],
        ]);

        return response()->json($cartService->remove($data['sku']));
    }

    public function clear(CartService $cartService): JsonResponse
    {
        return response()->json($cartService->clear());
    }
}