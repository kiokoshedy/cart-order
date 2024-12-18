<?php

namespace App\Services;

use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Auth;

class CartService
{
    private $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function addToCart(int $productId, int $quantity): void
    {
        $this->cartRepository->addToCart($productId, $quantity);
    }

    public function removeFromCart(int $productId): void
    {
        $this->cartRepository->removeFromCart($productId);
    }

    public function getUserCart()
    {
        return $this->cartRepository->getUserCart();
    }
}
