<?php

namespace App\Traits\Order;

use App\Shipping;
use App\Facades\ShoppingCart;

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
}
