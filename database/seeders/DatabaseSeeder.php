<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $testUser = User::query()->firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        User::query()->firstOrCreate([
            'email' => 'admin@meangirls.com',
        ], [
            'name' => 'Admin Plastics',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        $this->call([
            ProductSeeder::class,
            PostSeeder::class,
        ]);

        $product = Product::query()->first();
        if ($product) {
            Purchase::query()->firstOrCreate([
                'user_id' => $testUser->id,
                'product_id' => $product->id,
            ], [
                'price_paid' => $product->price,
            ]);
        }

        $products = Product::query()->get();
        if ($products->count() >= 3) {
            $p1 = $products[0];
            $p2 = $products[1];
            $p3 = $products[2];

            $order1 = \App\Models\Order::create([
                'user_id' => $testUser->id,
                'status' => 'paid',
                'total_price' => ($p1->price * 2) + $p2->price,
                'shipping_address' => 'Av. del Libertador 1234, CABA',
                'contact_phone' => '11-5555-1234',
                'created_at' => now()->subMonths(2),
                'updated_at' => now()->subMonths(2),
            ]);
            \App\Models\OrderItem::create([
                'order_id' => $order1->id,
                'product_id' => $p1->id,
                'quantity' => 2,
                'price' => $p1->price,
            ]);
            \App\Models\OrderItem::create([
                'order_id' => $order1->id,
                'product_id' => $p2->id,
                'quantity' => 1,
                'price' => $p2->price,
            ]);

            $order2 = \App\Models\Order::create([
                'user_id' => $testUser->id,
                'status' => 'paid',
                'total_price' => $p1->price,
                'shipping_address' => 'Corrientes 4500, CABA',
                'contact_phone' => '11-4444-5678',
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subMonth(),
            ]);
            \App\Models\OrderItem::create([
                'order_id' => $order2->id,
                'product_id' => $p1->id,
                'quantity' => 1,
                'price' => $p1->price,
            ]);

            $order3 = \App\Models\Order::create([
                'user_id' => $testUser->id,
                'status' => 'pending',
                'total_price' => $p3->price,
                'shipping_address' => 'Santa Fe 2300, CABA',
                'contact_phone' => '11-3333-9999',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            \App\Models\OrderItem::create([
                'order_id' => $order3->id,
                'product_id' => $p3->id,
                'quantity' => 1,
                'price' => $p3->price,
            ]);
        }
    }
}
