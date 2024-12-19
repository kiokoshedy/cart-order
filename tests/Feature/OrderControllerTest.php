<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the placeOrder API.
     */
    public function testPlaceOrder()
    {
        // Create a test user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create some test products
        $product1 = Product::factory()->create(['price' => 100]);
        $product2 = Product::factory()->create(['price' => 50]);

        // Mock cart items
        $cartItems = [
            ['product_id' => $product1->id, 'quantity' => 2],
            ['product_id' => $product2->id, 'quantity' => 1],
        ];

        // Send POST request to placeOrder API
        $response = $this->postJson('/api/orders', ['cart_items' => $cartItems]);

        // Assert response
        $response->assertStatus(200)
            ->assertJsonStructure(['message', 'order_id']);

        // Assert database
        $this->assertDatabaseHas('orders', ['user_id' => $user->id]);
        $this->assertDatabaseCount('order_items', 3); // 2 for product1 + 1 for product2
    }

    /**
     * Test the getOrderHistory API.
     */
    public function testGetOrderHistory()
    {
        // Create a test user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create test orders for the user
        $orders = Order::factory()->count(2)->create(['user_id' => $user->id]);

        // Send GET request to getOrderHistory API
        $response = $this->getJson('/api/orders/history');

        // Assert response
        $response->assertStatus(200)
            ->assertJsonStructure(['orders' => [['id', 'created_at', 'updated_at']]]);
    }
}
