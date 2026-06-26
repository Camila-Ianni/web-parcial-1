<?php

namespace App\Services;

use Illuminate\Support\Arr;

class CartService
{
    private const SESSION_KEY = 'cart.items';

    public function summary(): array
    {
        $items = $this->all();
        $count = array_sum(array_column($items, 'quantity'));
        $total = array_reduce($items, function (float $carry, array $item): float {
            return $carry + ((float) $item['price'] * (int) $item['quantity']);
        }, 0.0);

        return [
            'items' => array_values($items),
            'count' => $count,
            'total' => round($total, 2),
        ];
    }

    public function add(array $item): array
    {
        $items = $this->all();
        $sku = $item['sku'];

        if (isset($items[$sku])) {
            $items[$sku]['quantity']++;
        } else {
            $items[$sku] = [
                'sku' => $sku,
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => round((float) $item['price'], 2),
                'image' => Arr::get($item, 'image', ''),
                'quantity' => 1,
            ];
        }

        session([self::SESSION_KEY => $items]);

        return $this->summary();
    }

    public function remove(string $sku): array
    {
        $items = $this->all();
        unset($items[$sku]);

        session([self::SESSION_KEY => $items]);

        return $this->summary();
    }

    public function clear(): array
    {
        session([self::SESSION_KEY => []]);

        return $this->summary();
    }

    private function all(): array
    {
        return session(self::SESSION_KEY, []);
    }
}