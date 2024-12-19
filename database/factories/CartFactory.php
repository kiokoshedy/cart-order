<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Creates a new user
            'product_id' => $this->faker->randomNumber(), // Simulates a product ID
            'product_name' => $this->faker->words(3, true), // Generates a random product name
            'quantity' => $this->faker->numberBetween(1, 10), // Random quantity between 1 and 10
        ];
    }
}
