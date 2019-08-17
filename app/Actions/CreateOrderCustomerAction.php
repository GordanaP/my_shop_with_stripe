<?php

namespace App\Actions;

use App\Customer;
use App\Facades\ShoppingCart;

class CreateOrderCustomerAction
{
    public $user;

    public function __construct($user = null)
    {
        $this->user = $user;
    }

    public function execute()
    {
        if($this->user && $this->user->hasProfile()) {
            return $this->getRegisteredCustomer();
        }

        if($this->user && ! $this->user->hasProfile()) {
            return $this->createRegisteredCustomer();
        }

        if(! $this->user) {
            return $this->createGuestCustomer();
        }
    }

    public function getRegisteredCustomer()
    {
        return $this->user->customer;
    }

    public function createRegisteredCustomer()
    {
        $billingAddress = request()->address['billing'];

        return $this->user->addCustomer($billingAddress);
    }

    public function createGuestCustomer()
    {
        $billingAddress = ShoppingCart::fromSession()->getOwner('address', 'billing')
            ->toArray();

        return Customer::create($billingAddress);
    }
}