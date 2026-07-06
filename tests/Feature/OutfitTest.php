<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OutfitTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\ProductSeeder::class);
    }

    public function test_admin_dashboard_shows_correct_outfits_count(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('8');
    }

    public function test_create_outfit_form_has_two_upload_sections(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)
            ->get(route('admin.products.create'));

        $response->assertStatus(200);
        
        $response->assertSee('Sección 1: Imagen Principal del Outfit');
        $response->assertSee('name="image"', false);
        
        $response->assertSee('Sección 2: Prendas Individuales (Dressing Pieces)');
        $response->assertSee('Agregar Nueva Prenda');
    }

    public function test_can_create_outfit_with_main_image_and_garment_images(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['is_admin' => true]);

        $mainImage = UploadedFile::fake()->create('outfit_main.png', 100);
        $garmentImage = UploadedFile::fake()->create('top_piece.png', 100);

        $category = Category::query()->firstOrCreate(['slug' => 'outfits'], ['name' => 'Outfits', 'type' => 'product']);

        $postData = [
            'name' => 'Custom Y2K Set',
            'slug' => 'custom-y2k-set',
            'description' => 'Wednesday special edition outfit',
            'category_id' => $category->id,
            'price' => '150.00',
            'stock' => '5',
            'is_active' => '1',
            'image' => $mainImage,
            'garments' => [
                [
                    'title' => 'Vintage Pink Top',
                    'price' => '$45.00',
                    'desc' => 'Ribbed pink top garment',
                    'image' => $garmentImage,
                    'style' => 'width:340px; top:100px; left:40.5%; transform:translateX(-50%);',
                ]
            ]
        ];

        $response = $this->actingAs($admin)
            ->post(route('admin.products.store'), $postData);

        $response->assertRedirect(route('admin.products.index'));

        $product = Product::query()->where('slug', 'custom-y2k-set')->first();
        $this->assertNotNull($product);
        $this->assertEquals('Custom Y2K Set', $product->name);
        $this->assertCount(1, $product->garments);

        $garment = $product->garments[0];
        $this->assertEquals('Vintage Pink Top', $garment['title']);
        $this->assertStringContainsString('uploads/', $product->image_path);
        $this->assertStringContainsString('uploads/', $garment['src']);

        $mainFile = public_path($product->image_path);
        $garmentFile = public_path($garment['src']);
        if (file_exists($mainFile)) {
            unlink($mainFile);
        }
        if (file_exists($garmentFile)) {
            unlink($garmentFile);
        }
    }

    public function test_public_lookbook_page_lists_all_outfits_dynamically(): void
    {
        $response = $this->get(route('products.index'));

        $response->assertStatus(200);

        $response->assertSee('Plastics Signature');
        $response->assertSee('Pink Army');
        $response->assertSee('Vintage Pink');
        $response->assertSee('Burn Book Chic');
        $response->assertSee('Mall Tour');
        $response->assertSee('Gretchen');
        $response->assertSee('Regina');
        $response->assertSee('Karen');
    }

    public function test_home_page_renders_with_mean_girls_aesthetic(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);

        $response->assertSee('We Wear Pink');
        $response->assertSee('Get In, Loser!');
        $response->assertSee('You Can\'t Sit With Us!', false);
        $response->assertSee('Is butter a carb?');
    }

    public function test_non_admin_login_redirects_to_home(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));

        $followResponse = $this->actingAs($user)->get('/admin');
        $followResponse->assertStatus(403);
    }

    public function test_auth_user_post_to_login_redirects_to_home(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));
    }

    public function test_user_registers_as_non_admin_by_default(): void
    {
        $postData = [
            'name' => 'Regina George',
            'email' => 'regina@plastics.com',
            'password' => 'fetch123',
            'password_confirmation' => 'fetch123',
        ];

        $response = $this->post(route('register.attempt'), $postData);

        $response->assertRedirect(route('home'));

        $user = User::query()->where('email', 'regina@plastics.com')->first();
        $this->assertNotNull($user);
        $this->assertFalse($user->is_admin);
    }

    public function test_admin_can_toggle_another_user_role(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $targetUser = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($admin)
            ->patch(route('admin.users.toggle-role', $targetUser));

        $response->assertRedirect(route('admin.users.show', $targetUser));
        
        $targetUser->refresh();
        $this->assertTrue($targetUser->is_admin);
    }

    public function test_admin_cannot_toggle_own_role(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)
            ->patch(route('admin.users.toggle-role', $admin));

        $response->assertSessionHasErrors(['role']);
        
        $admin->refresh();
        $this->assertTrue($admin->is_admin);
    }

    public function test_non_admin_cannot_toggle_user_role(): void
    {
        $user = User::factory()->create(['is_admin' => false]);
        $targetUser = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)
            ->patch(route('admin.users.toggle-role', $targetUser));

        $response->assertStatus(403);
        
        $targetUser->refresh();
        $this->assertFalse($targetUser->is_admin);
    }
}
