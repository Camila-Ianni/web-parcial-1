<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CheckoutTest
 *
 * Feature tests for checkout process, profile updates, and admin dashboard statistics.
 *
 * @package Tests\Feature
 */
class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up tests with necessary seed data.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\ProductSeeder::class);
    }

    /**
     * Test checkout page is accessible when cart has items.
     *
     * @return void
     */
    public function test_checkout_page_requires_auth_and_non_empty_cart(): void
    {
        // 1. Unauthenticated redirects to login
        $response = $this->get(route('checkout.index'));
        $response->assertRedirect(route('login'));

        // 2. Authenticated but empty cart redirects with error
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('checkout.index'));
        $response->assertRedirect(route('products.index'));
        $response->assertSessionHasErrors(['cart']);

        // 3. Authenticated and items in cart works
        $product = Product::query()->first();
        
        // Add item to cart session
        session(['cart.items' => [
            $product->slug => [
                'sku' => $product->slug,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'image' => $product->image_path,
                'quantity' => 2,
            ]
        ]]);

        $response = $this->actingAs($user)->get(route('checkout.index'));
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    /**
     * Test checkout store validates shipping and creates pending order.
     *
     * @return void
     */
    public function test_checkout_store_creates_pending_order_and_redirects(): void
    {
        $user = User::factory()->create();
        $product = Product::query()->first();

        session(['cart.items' => [
            $product->slug => [
                'sku' => $product->slug,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'image' => $product->image_path,
                'quantity' => 1,
            ]
        ]]);

        // Submit form with missing address
        $response = $this->actingAs($user)->post(route('checkout.store'), [
            'contact_phone' => '12345678',
        ]);
        $response->assertSessionHasErrors(['shipping_address']);

        // Submit complete form
        $response = $this->actingAs($user)->post(route('checkout.store'), [
            'shipping_address' => 'Test Address 123',
            'contact_phone' => '12345678',
        ]);

        // Should redirect (either to MercadoPago init point or fallback redirect)
        $response->assertRedirect();

        // Verify order is in DB in pending state
        $order = Order::query()->where('user_id', $user->id)->first();
        $this->assertNotNull($order);
        $this->assertEquals('pending', $order->status);
        $this->assertEquals('Test Address 123', $order->shipping_address);
        $this->assertEquals('12345678', $order->contact_phone);
        $this->assertEquals($product->price, $order->total_price);
        $this->assertCount(1, $order->items);
    }

    /**
     * Test checkout success callback updates order and empties cart.
     *
     * @return void
     */
    public function test_checkout_success_updates_status_and_clears_cart(): void
    {
        $user = User::factory()->create();
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_price' => 150.00,
            'shipping_address' => 'Calle Falsa 123',
            'contact_phone' => '9999-9999',
        ]);

        session(['cart.items' => ['some-sku' => ['name' => 'Item'] ]]);

        $response = $this->actingAs($user)->get(route('checkout.success', [
            'order' => $order->id,
            'payment_id' => 'mp-payment-id-123'
        ]));

        $response->assertStatus(200);
        $response->assertSee('Tu compra se ha registrado con éxito');

        // Check DB update
        $order->refresh();
        $this->assertEquals('paid', $order->status);
        $this->assertEquals('mp-payment-id-123', $order->payment_id);

        // Check cart is empty
        $this->assertEmpty(session('cart.items'));
    }

    /**
     * Test profile view and edit.
     *
     * @return void
     */
    public function test_user_profile_view_and_update(): void
    {
        $user = User::factory()->create([
            'name' => 'Cady Heron',
            'email' => 'cady@northshore.com',
        ]);

        // View profile
        $response = $this->actingAs($user)->get(route('profile.show'));
        $response->assertStatus(200);
        $response->assertSee('Cady Heron');

        // Update profile
        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => 'Cady Regina',
            'email' => 'cady_new@northshore.com',
            'password' => 'plastics',
            'password_confirmation' => 'plastics',
        ]);

        $response->assertRedirect(route('profile.show'));
        $response->assertSessionHas('status', 'Perfil actualizado exitosamente.');

        $user->refresh();
        $this->assertEquals('Cady Regina', $user->name);
        $this->assertEquals('cady_new@northshore.com', $user->email);
        $this->assertTrue(\Hash::check('plastics', $user->password));
    }

    /**
     * Test admin dashboard statistics calculation.
     *
     * @return void
     */
    public function test_admin_dashboard_shows_correct_statistics(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create();
        $product = Product::query()->first();

        // 1. Create a paid order
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'paid',
            'total_price' => $product->price * 3,
            'shipping_address' => 'CABA',
            'contact_phone' => '123',
        ]);

        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 3,
            'price' => $product->price,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);

        // Check if statistics are rendered in dashboard view
        $response->assertSee(number_format($product->price * 3, 2));
        $response->assertSee($product->name);
    }
}
