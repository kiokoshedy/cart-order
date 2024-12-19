<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $userId = auth()->id();
        $cart = Cart::where('user_id', $userId)->get();

        return response()->json(['cart' => $cart]);
    }

    /**
     * Add an item to the cart.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['cart' => $cart, 'message' => 'Item added to cart.']);
    }

    /**
     * Remove an item from the cart.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $cart->delete();

        return response()->json(['message' => 'Item removed from cart.']);
    }
}
