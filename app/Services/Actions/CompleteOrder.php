<?php

namespace App\Services\Actions;

use App\Order;

class CompleteOrder
{
    public function handle($shippingId, $paymentIntent)
    {
        return Order::fromShoppingCart()
            ->completeShipping($shippingId)
            ->completePayment($paymentIntent);
    }
}