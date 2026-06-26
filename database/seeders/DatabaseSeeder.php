<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
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

        // Create a default purchase for the test user
        $product = \App\Models\Product::query()->first();
        if ($product) {
            \App\Models\Purchase::query()->firstOrCreate([
                'user_id' => $testUser->id,
                'product_id' => $product->id,
            ], [
                'price_paid' => $product->price,
            ]);
        }
    }
}
