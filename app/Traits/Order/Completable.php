<?php

namespace App\Traits\Order;

use App\Order;

trait Completable
{
    public function completeOrder($shippingId, $paymentIntent)
    {
        return Order::fromShoppingCart()
            ->completeShipping($shippingId)
            ->completePayment($paymentIntent);
    }
}