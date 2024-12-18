<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function placeOrder(array $cartItems): \App\Models\Order
    {
        return $this->orderRepository->placeOrder($cartItems);
    }

    public function getUserOrders()
    {
        return $this->orderRepository->getUserOrders();
    }
}
