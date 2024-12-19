<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Place an order from the user's cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function placeOrder()
    {
        $userId = auth()->id();
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty.'], 400);
        }

        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * 10; // Assume each product has a fixed price of 10 for simplicity
        });

        $order = Order::create([
            'user_id' => $userId,
            'status' => 'pending',
            'total_amount' => $totalAmount,
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product_name,
                'quantity' => $cartItem->quantity,
                'price' => 10, // Assume a fixed price of 10
            ]);

            $cartItem->delete();
        }

        return response()->json(['order' => $order, 'message' => 'Order placed successfully.']);
    }

    /**
     * Display the order history for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrderHistory()
    {
        $userId = auth()->id();
        $orders = Order::with('items')->where('user_id', $userId)->get();

        return response()->json(['orders' => $orders]);
    }
}
