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
    }
}
