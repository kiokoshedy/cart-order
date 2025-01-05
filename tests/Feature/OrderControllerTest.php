<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_user_can_place_order()
    {
        $product = Product::factory()->create(['price' => 100]);

        Cart::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response = $this->postJson('/api/orders');

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Order placed successfully']);
    }

    public function test_user_cannot_place_order_with_empty_cart()
    {
        $response = $this->postJson('/api/orders');

        $response->assertStatus(400)
                 ->assertJson(['message' => 'Your cart is empty']);
    }

    public function test_user_can_view_orders()
    {
        Order::factory()->create(['user_id' => $this->user->id]);

        $response = $this->getJson('/api/orders');

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }
}
