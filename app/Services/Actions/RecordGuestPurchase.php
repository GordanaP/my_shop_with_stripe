<?php

namespace App\Services\Actions;

use App\Customer;
use App\Shipping;
use App\Traits\Order\Completable;

class RecordGuestPurchase
{
    use Completable;

    public function handle($paymentIntent)
    {
        $customer = Customer::createFromShoppingCart();

        $order = $this->completeOrder($this->getShipping($customer), $paymentIntent);

        return $customer->placeOrder($order);
    }

    protected function getShipping($customer)
    {
        $shipping = Shipping::getFromShoppingCart();

        return $shipping ? $customer->addShipping($shipping)->id  : null;
    }
}