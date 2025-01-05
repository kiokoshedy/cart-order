<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CartControllerTest extends TestCase
{
    use RefreshDatabase; // Resets database after each test

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create user with factory and mock authentication
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_user_can_view_cart_items()
    {
        Cart::factory()->create(['user_id' => $this->user->id]);

        $response = $this->getJson('/api/cart');

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }

    public function test_user_can_add_item_to_cart()
    {
        $product = Product::factory()->create();

        $response = $this->postJson('/api/cart', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Item added to cart']);
    }

    public function test_user_can_remove_item_from_cart()
    {
        $cart = Cart::factory()->create(['user_id' => $this->user->id]);

        $response = $this->deleteJson("/api/cart/{$cart->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Item removed from cart']);
    }
}
