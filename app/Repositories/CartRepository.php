<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartRepository
{
    public function addToCart(int $productId, int $quantity): void
    {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    public function removeFromCart(int $productId): void
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();
    }

    public function getUserCart()
    {
        return Cart::where('user_id', Auth::id())
            ->get();
    }
}
