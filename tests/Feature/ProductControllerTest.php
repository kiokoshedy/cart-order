<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_user_can_create_a_product()
{
    // Mock storage
    Storage::fake('public');

    // Upload a fake image
    $image = UploadedFile::fake()->image('product.jpg');

    $response = $this->postJson('/api/products', [
        'name' => 'Test Product',
        'description' => 'Test Description',
        'price' => 99.99,
        'stock' => 10,
        'image' => $image,
    ]);

    $response->assertStatus(201)
             ->assertJson(['name' => 'Test Product']);

    // Assert the file exists in storage
    Storage::disk('public')->assertExists('products/' . $image->hashName());
}

    public function test_user_can_view_all_products()
    {
        Product::factory(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_user_can_view_a_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJson(['id' => $product->id]);
    }
}
