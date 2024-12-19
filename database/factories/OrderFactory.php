<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Creates a new user
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']), // Random status
            'total_amount' => $this->faker->randomFloat(2, 10, 1000), // Random amount between 10 and 1000
        ];
    }
}
