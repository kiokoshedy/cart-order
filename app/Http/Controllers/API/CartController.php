<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $cartItems = Cart::where('user_id', $userId)->get();

        return response()->json($cartItems);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = $request->user()->id;
        $product = Product::findOrFail($validated['product_id']);

        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => $userId,
                'product_id' => $product->id,
            ],
            [
                'product_name' => $product->name,
                'quantity' => $validated['quantity'],
            ]
        );

        return response()->json(['message' => 'Item added to cart', 'cartItem' => $cartItem], 201);
    }

    public function destroy($id)
    {
        $userId = auth()->id();
        $cartItem = Cart::where('user_id', $userId)->where('id', $id)->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }
}
