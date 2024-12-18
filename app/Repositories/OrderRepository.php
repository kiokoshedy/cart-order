<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    public function placeOrder(array $cartItems): Order
    {
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total_amount' => 0, // Calculate the total amount based on the cart items
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return $order;
    }

    public function getUserOrders()
    {
        return Order::where('user_id', Auth::id())
            ->with('items')
            ->get();
    }
}
