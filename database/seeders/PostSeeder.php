<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'How We Curate Wednesday Drops',
                'slug' => 'how-we-curate-wednesday-drops',
                'excerpt' => 'A look behind our weekly outfit curation process.',
                'content' => 'Every drop is curated around a clear mood board, product availability, and outfit compatibility. We combine statement tops, practical layers, and accessories that can be mixed for everyday wear while keeping the iconic pink direction.',
                'author_name' => 'Regina Team',
                'category' => 'Novedades',
                'image_path' => 'img/outfit1.png',
                'is_published' => true,
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Top 5 Accessories for the Lookbook',
                'slug' => 'top-5-accessories-for-the-lookbook',
                'excerpt' => 'The accessories that sold out first and why.',
                'content' => 'Accessories define the finish of each set. Bags, layered necklaces, and standout shoes bring cohesion and make each outfit easy to personalize. We selected five essentials that keep the look playful and polished.',
                'author_name' => 'Style Desk',
                'category' => 'Blog',
                'image_path' => 'img/bag1.png',
                'is_published' => true,
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'New Fabric Guide for Spring 2026',
                'slug' => 'new-fabric-guide-for-spring-2026',
                'excerpt' => 'Comfort and texture tips before buying your next outfit.',
                'content' => 'Spring fabrics need balance. Ribbed cotton and flexible denim are ideal for all-day use. We document each material so clients know how to maintain color, shape, and softness over time.',
                'author_name' => 'Product Lab',
                'category' => 'Noticias',
                'image_path' => 'img/top1.png',
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
        ];

        foreach ($posts as $post) {
            Post::query()->updateOrCreate([
                'slug' => $post['slug'],
            ], $post);
        }
    }
}