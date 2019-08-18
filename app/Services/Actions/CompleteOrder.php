<?php

namespace App\Services\Actions;

use App\Order;

class CompleteOrder
{
    public $customer;
    public $shippingId;

    public function __construct($customer, $shippingId)
    {
        $this->customer = $customer;
        $this->shippingId = $shippingId;
    }

    public function handle($paymentIntent)
    {
        $order = $this->getOrder($this->shippingId, $paymentIntent);

        return $this->customer->placeOrder($order);
    }

    public function getOrder($shippingId, $paymentIntent)
    {
        return Order::fromShoppingCart()
            ->completeShipping($shippingId)
            ->completePayment($paymentIntent);
    }
}