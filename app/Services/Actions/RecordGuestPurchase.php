<?php

namespace App\Services\Actions;

use App\Customer;
use App\Shipping;
use App\Services\Actions\CompleteOrder;

class RecordGuestPurchase
{
    public function handle($paymentIntent)
    {
        $customer = Customer::createFromShoppingCart();
        $shippingId = $this->getShippingId($customer);

        return (new CompleteOrder($customer, $shippingId))->handle($paymentIntent);
    }

    protected function getShippingId($customer)
    {
        $shipping = Shipping::getFromShoppingCart();

        return $shipping ? $customer->addShipping($shipping)->id  : null;
    }
}