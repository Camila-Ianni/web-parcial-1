<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CartController
 *
 * Handles client-side shopping cart operations.
 *
 * @package App\Http\Controllers
 */
class CartController extends Controller
{
    /**
     * Get the shopping cart summary.
     *
     * @param  \App\Services\CartService  $cartService
     * @return \Illuminate\Http\JsonResponse
     */
    public function summary(CartService $cartService): JsonResponse
    {
        return response()->json($cartService->summary());
    }

    /**
     * Add an item to the shopping cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\CartService  $cartService
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Remove an item from the shopping cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\CartService  $cartService
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(Request $request, CartService $cartService): JsonResponse
    {
        $data = $request->validate([
            'sku' => ['required', 'string', 'max:120'],
        ]);

        return response()->json($cartService->remove($data['sku']));
    }

    /**
     * Clear all items from the shopping cart.
     *
     * @param  \App\Services\CartService  $cartService
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear(CartService $cartService): JsonResponse
    {
        return response()->json($cartService->clear());
    }
}