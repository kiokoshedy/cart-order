<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $userId = $request->user()->id;

        // Get user's cart items
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Your cart is empty'], 400);
        }

        // Calculate total amount
        $totalAmount = $cartItems->reduce(function ($total, $item) {
            return $total + ($item->quantity * $item->product->price);
        }, 0);

        // Create an order
        $order = Order::create([
            'user_id' => $userId,
            'status' => 'pending',
            'total_amount' => $totalAmount,
        ]);

        // Add items to the order
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $cartItem->product_name,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        // Clear the cart
        Cart::where('user_id', $userId)->delete();

        return response()->json(['message' => 'Order placed successfully', 'order' => $order]);
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $orders = Order::where('user_id', $userId)->with('items')->get();

        return response()->json($orders);
    }
}
