<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function placeOrder(PlaceOrderRequest $request): JsonResponse
    {
        $order = $this->orderService->placeOrder($request->input('cart_items'));

        return response()->json([
            'message' => 'Order placed successfully.',
            'order_id' => $order->id,
        ], 200);
    }

    public function getOrderHistory(): JsonResponse
    {
        $orders = $this->orderService->getUserOrders();

        return response()->json([
            'orders' => $orders,
        ], 200);
    }
}
