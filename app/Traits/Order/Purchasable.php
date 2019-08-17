<?php

namespace App\Traits\Order;

use App\Customer;
use App\Shipping;

trait Purchasable
{
    protected function getRegisteredShippingId()
    {
        $shippingAddress = collect(request()->address);

        return $shippingAddress->has('customer_id') ? $shippingAddress->get('id') : null;
    }

    protected function createRegisteredShippingId($customer)
    {
        $address = collect(request()->address);
        $shipping = $address->get('shipping');

        return $address->has('shipping') ? $customer->addShipping($shipping)->id : null;
    }

    protected function createGuestShippingId($customer)
    {
        $shippingAddress = Shipping::fromShoppingCart();

        return $shippingAddress ? $customer->addShipping($shippingAddress)->id : null;
    }

    protected function getRegisteredCustomer()
    {
        return $this->user->customer;
    }

    protected function createRegisteredCustomer()
    {
        $address = collect(request()->address);
        $billingAddress = $address->get('billing');

        return $this->user->addCustomer($billingAddress);
    }

    protected function createGuestCustomer()
    {
        $billingAddress = Customer::fromShoppingCart();

        return Customer::create($billingAddress);
    }
}
