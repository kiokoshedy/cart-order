<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create some users
        User::factory()
            ->count(10) // Create 10 users
            ->create();

        // Create carts for users
        Cart::factory()
            ->count(20) // Create 20 cart records
            ->create();

        // Create orders and associated order items
        Order::factory()
            ->count(15) // Create 15 orders
            ->has(OrderItem::factory()->count(5), 'items') // Each order has 5 items
            ->create();

        // Additional seeding logic if needed
    }
}

