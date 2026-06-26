<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Plaid Buttoned-up Polo',
                'slug' => 'plaid-buttoned-up-polo',
                'category' => 'Tops',
                'description' => 'Classic plaid polo inspired by the Wednesday look.',
                'price' => 8100.00,
                'stock' => 20,
                'image_path' => 'img/shirt.png',
                'is_active' => true,
            ],
            [
                'name' => 'Ribbon Cardigan',
                'slug' => 'ribbon-cardigan',
                'category' => 'Tops',
                'description' => 'Soft knit cardigan with ribbon accents.',
                'price' => 1600.00,
                'stock' => 30,
                'image_path' => 'img/cardigan.png',
                'is_active' => true,
            ],
            [
                'name' => 'Pink Army Set',
                'slug' => 'pink-army-set',
                'category' => 'Outfits',
                'description' => 'Coordinated set featuring biker details and pink textures.',
                'price' => 4200.00,
                'stock' => 15,
                'image_path' => 'img/outfit2.png',
                'is_active' => true,
            ],
            [
                'name' => 'Burn Book Chic',
                'slug' => 'burn-book-chic',
                'category' => 'Outfits',
                'description' => 'Statement look for premium style drops.',
                'price' => 5100.00,
                'stock' => 12,
                'image_path' => 'img/outfit 4.png',
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate([
                'slug' => $product['slug'],
            ], $product);
        }
    }
}