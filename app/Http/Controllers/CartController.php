<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(AddToCartRequest $request): JsonResponse
    {
        $this->cartService->addToCart(
            $request->input('product_id'),
            $request->input('quantity')
        );

        return response()->json([
            'message' => 'Item added to cart successfully.',
        ], 200);
    }

    public function removeFromCart(int $productId): JsonResponse
    {
        $this->cartService->removeFromCart($productId);

        return response()->json([
            'message' => 'Item removed from cart successfully.',
        ], 200);
    }

    public function getCart(): JsonResponse
    {
        $cart = $this->cartService->getUserCart();

        return response()->json([
            'cart' => $cart,
        ], 200);
    }
}
