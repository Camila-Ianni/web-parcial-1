<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::query()->firstOrCreate([
            'slug' => 'outfits',
        ], [
            'name' => 'Outfits',
            'type' => 'product',
        ]);

        $products = [
            [
                'name' => 'Plastics Signature',
                'slug' => 'plastics-signature',
                'category_id' => $category->id,
                'description' => 'Wednesday Collection',
                'price' => 274.90,
                'stock' => 10,
                'image_path' => 'img/outfit1.png',
                'is_active' => true,
                'garments' => [
                    [ 'src' => 'img/shoes1.png', 'style' => 'width:210px; top:490px; left:15%; transform:rotate(-5deg);', 'title' => 'Chic Pink Mules', 'desc' => 'Glossy retro slingbacks with kitten heel.', 'price' => '$75.00' ],
                    [ 'src' => 'img/top1.png', 'style' => 'width:340px; top:100px; left:40.5%; transform:translateX(-50%);', 'title' => 'Soft Pink Top', 'desc' => 'Exclusive ribbed knit design.', 'price' => '$45.00' ],
                    [ 'src' => 'img/pants.png', 'style' => 'width:295px; top:330px; left:59.5%; transform:translateX(-50%);', 'title' => 'Flare Blue Jeans', 'desc' => 'Classic Y2K denim.', 'price' => '$89.90' ],
                    [ 'src' => 'img/bag1.png', 'style' => 'width:200px; top:250px; right:12%; transform:rotate(8deg);', 'title' => 'Rhinestone Bag', 'desc' => 'Sparkly pink crystals.', 'price' => '$65.00' ]
                ]
            ],
            [
                'name' => 'Pink Army',
                'slug' => 'pink-army',
                'category_id' => $category->id,
                'description' => 'Spring 2026 Edition',
                'price' => 310.00,
                'stock' => 15,
                'image_path' => 'img/outfit2.png',
                'is_active' => true,
                'garments' => [
                    [ 'src' => 'img/boots2.png', 'style' => 'width:225px; top:480px; left:52%; transform:translateX(-50%);', 'title' => 'Combat Boots', 'desc' => 'Black leather platform boots.', 'price' => '$110.00' ],
                    [ 'src' => 'img/skirt2.png', 'style' => 'width:300px; top:270px; left:55%; transform:translateX(-50%);', 'title' => 'Pink Ruffle Skirt', 'desc' => 'Layered ruffles.', 'price' => '$55.00' ],
                    [ 'src' => 'img/top2.png', 'style' => 'width:215px; top:110px; left:46.5%; transform:translateX(-50%);', 'title' => 'Gray Tube Top', 'desc' => 'Essential basic.', 'price' => '$25.00' ],
                    [ 'src' => 'img/jacket2.png', 'style' => 'width:260px; top:40px; right:12%; transform:rotate(10deg);', 'title' => 'Biker Bow Jacket', 'desc' => 'Faux leather with pink bow details.', 'price' => '$120.00' ]
                ]
            ],
            [
                'name' => 'Vintage Pink',
                'slug' => 'vintage-pink',
                'category_id' => $category->id,
                'description' => 'Limited Release',
                'price' => 236.00,
                'stock' => 8,
                'image_path' => 'img/outfit3.png',
                'is_active' => true,
                'garments' => [
                    [ 'src' => 'img/shoes1.png', 'style' => 'width:210px; top:485px; left:50%; transform:translateX(-50%);', 'title' => 'Pink Kitten Heels', 'desc' => 'Cute patent leather slingbacks.', 'price' => '$75.00' ],
                    [ 'src' => 'img/jeans3.png', 'style' => 'width:260px; top:310px; left:59.5%; transform:translateX(-50%);', 'title' => 'Low Rise Denim', 'desc' => 'Stretched vintage low waist jeans.', 'price' => '$95.00' ],
                    [ 'src' => 'img/top3.png', 'style' => 'width:260px; top:110px; left:45.5%; transform:translateX(-50%);', 'title' => 'Vintage Logo Tee', 'desc' => 'Printed graphic cotton tee.', 'price' => '$38.00' ],
                    [ 'src' => 'img/necklace3.png', 'style' => 'width:130px; top:45px; left:48%; transform:translateX(-50%);', 'title' => 'Choker Star', 'desc' => 'Rhinestone star choker necklace.', 'price' => '$28.00' ]
                ]
            ],
            [
                'name' => 'Burn Book Chic',
                'slug' => 'burn-book-chic',
                'category_id' => $category->id,
                'description' => 'Class of 2026',
                'price' => 326.00,
                'stock' => 12,
                'image_path' => 'img/outfit 4.png',
                'is_active' => true,
                'garments' => [
                    [ 'src' => 'img/boots3.png', 'style' => 'width:240px; top:460px; left:53.5%; transform:translateX(-50%);', 'title' => 'Knee High Pink Boots', 'desc' => 'Pointy toe glossy high boots.', 'price' => '$145.00' ],
                    [ 'src' => 'img/skirt2.png', 'style' => 'width:300px; top:280px; left:55%; transform:translateX(-50%);', 'title' => 'Plissée Pink Skirt', 'desc' => 'Pleated micro skirt.', 'price' => '$48.00' ],
                    [ 'src' => 'img/cardigan.png', 'style' => 'width:270px; top:100px; left:43.5%; transform:translateX(-50%);', 'title' => 'Preppy Pink Cardigan', 'desc' => 'Cozy cropped knit cardigan.', 'price' => '$68.00' ],
                    [ 'src' => 'img/bag1.png', 'style' => 'width:180px; top:200px; right:14%; transform:rotate(-8deg);', 'title' => 'Gossip Rhinestone Clutch', 'desc' => 'Small sparkling rhinestone bag.', 'price' => '$65.00' ]
                ]
            ],
            [
                'name' => 'Mall Tour',
                'slug' => 'mall-tour',
                'category_id' => $category->id,
                'description' => 'Casual Set',
                'price' => 197.00,
                'stock' => 20,
                'image_path' => 'img/outfit5.png',
                'is_active' => true,
                'garments' => [
                    [ 'src' => 'img/shoes1.png', 'style' => 'width:200px; top:490px; left:50%; transform:translateX(-50%);', 'title' => 'Platform Slides', 'desc' => 'Fluffy pink sandals.', 'price' => '$45.00' ],
                    [ 'src' => 'img/pants.png', 'style' => 'width:290px; top:300px; left:59.5%; transform:translateX(-50%);', 'title' => 'Pink Sweatpants', 'desc' => 'Comfy cotton jogger pants.', 'price' => '$60.00' ],
                    [ 'src' => 'img/shirt.png', 'style' => 'width:235px; top:110px; left:44.5%; transform:translateX(-50%);', 'title' => 'Baby Doll Tee', 'desc' => 'Fitted cropped doll tee.', 'price' => '$32.00' ],
                    [ 'src' => 'img/bag1.png', 'style' => 'width:190px; top:220px; left:12%; transform:rotate(12deg);', 'title' => 'Pink Shoulder Bag', 'desc' => 'Mini baguette handbag.', 'price' => '$50.00' ]
                ]
            ],
            [
                'name' => "Gretchen's Style",
                'slug' => 'gretchens-style',
                'category_id' => $category->id,
                'description' => 'Rich & Famous',
                'price' => 384.00,
                'stock' => 7,
                'image_path' => 'img/outfit6.png',
                'is_active' => true,
                'garments' => [
                    [ 'src' => 'img/boots3.png', 'style' => 'width:245px; top:460px; left:53.5%; transform:translateX(-50%);', 'title' => 'Suede Thigh Boots', 'desc' => 'Luxury high boots in baby pink.', 'price' => '$150.00' ],
                    [ 'src' => 'img/skirt2.png', 'style' => 'width:300px; top:280px; left:55%; transform:translateX(-50%);', 'title' => 'Plaid Pleated Skirt', 'desc' => 'Classic academy pleated style.', 'price' => '$59.00' ],
                    [ 'src' => 'img/top1.png', 'style' => 'width:340px; top:110px; left:40.5%; transform:translateX(-50%);', 'title' => 'Regina Knit Corset', 'desc' => 'Off-shoulder structured pink top.', 'price' => '$55.00' ],
                    [ 'src' => 'img/jacket2.png', 'style' => 'width:260px; top:40px; right:12%; transform:rotate(10deg);', 'title' => 'Chic Biker Jacket', 'desc' => 'Pink faux leather biker jacket.', 'price' => '$120.00' ]
                ]
            ],
            [
                'name' => "Regina's Choice",
                'slug' => 'reginas-choice',
                'category_id' => $category->id,
                'description' => 'Boss Lady',
                'price' => 365.00,
                'stock' => 5,
                'image_path' => 'img/outfit1.png',
                'is_active' => true,
                'garments' => [
                    [ 'src' => 'img/boots3.png', 'style' => 'width:245px; top:460px; left:53.5%; transform:translateX(-50%);', 'title' => 'Leather Platform Boots', 'desc' => 'High platform shiny pink boots.', 'price' => '$130.00' ],
                    [ 'src' => 'img/jeans3.png', 'style' => 'width:265px; top:315px; left:59.5%; transform:translateX(-50%);', 'title' => 'Glitter Pocket Jeans', 'desc' => 'Denim pants with rhinestone back pockets.', 'price' => '$110.00' ],
                    [ 'src' => 'img/top3.png', 'style' => 'width:260px; top:120px; left:45.5%; transform:translateX(-50%);', 'title' => 'Queen Tiara Tee', 'desc' => 'Crown graphic fitted tee.', 'price' => '$40.00' ],
                    [ 'src' => 'img/bag1.png', 'style' => 'width:190px; top:200px; left:10%; transform:rotate(-15deg);', 'title' => 'Metallic Bow Bag', 'desc' => 'Glamorous silver-pink handbag.', 'price' => '$85.00' ]
                ]
            ],
            [
                'name' => "Karen's Vibes",
                'slug' => 'karens-vibes',
                'category_id' => $category->id,
                'description' => 'Pink Weather',
                'price' => 282.00,
                'stock' => 12,
                'image_path' => 'img/outfit2.png',
                'is_active' => true,
                'garments' => [
                    [ 'src' => 'img/boots2.png', 'style' => 'width:220px; top:480px; left:52%; transform:translateX(-50%);', 'title' => 'Karen Platform Booties', 'desc' => 'Comfy chunky suede booties.', 'price' => '$95.00' ],
                    [ 'src' => 'img/pants.png', 'style' => 'width:290px; top:310px; left:59.5%; transform:translateX(-50%);', 'title' => 'Pink Satin Pants', 'desc' => 'Smooth flowing wide-leg trousers.', 'price' => '$80.00' ],
                    [ 'src' => 'img/cardigan.png', 'style' => 'width:270px; top:100px; left:43.5%; transform:translateX(-50%);', 'title' => 'Fluffy Pink Knit', 'desc' => 'Super soft oversized crop knit.', 'price' => '$72.00' ],
                    [ 'src' => 'img/necklace3.png', 'style' => 'width:130px; top:45px; left:48%; transform:translateX(-50%);', 'title' => 'Crystal Heart Pendant', 'desc' => 'Large silver heart necklace.', 'price' => '$35.00' ]
                ]
            ]
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate([
                'slug' => $product['slug'],
            ], $product);
        }
    }
}