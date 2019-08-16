<?php

namespace App\Actions;

use App\User;
use App\Order;
use App\Facades\ShoppingCart;

class CompletePurchaseAction
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function execute($paymentIntent)
    {
        $order = Order::fromShoppingCart()->completePayment($paymentIntent);

        return $this->user->customer->placeOrder($order);
    }
}