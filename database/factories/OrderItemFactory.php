<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(), // Creates a new order
            'product_id' => $this->faker->randomNumber(), // Simulates a product ID
            'product_name' => $this->faker->words(3, true), // Generates a random product name
            'quantity' => $this->faker->numberBetween(1, 10), // Random quantity between 1 and 10
            'price' => $this->faker->randomFloat(2, 1, 500), // Random price between 1 and 500
        ];
    }
}
