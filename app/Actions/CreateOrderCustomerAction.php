<?php

namespace App\Actions;

use App\Customer;
use App\Traits\Order\Purchasable;

class CreateOrderCustomerAction
{
    use Purchasable;

    public function execute($user = null)
    {
        if($user && $user->hasProfile()) {
            return $user->customer;
        }

        if($user && ! $user->hasProfile()) {
            return $this->createRegisteredCustomer($user);
        }

        return Customer::fromShoppingCart();
    }
}

