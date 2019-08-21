<?php

namespace App\Services\UseCases;

use App\Customer;
use App\Shipping;
use App\Services\AbstractClasses\Purchase;

class GuestPurchase extends Purchase
{
    /**
     * {@inheritDoc}
     */
    public function __construct($payment)
    {
        parent::__construct($payment);
    }

    /**
     * {@inheritDoc}
     */
    protected function getBillingAddress()
    {
        return $this->getAddress();
    }

    /**
     * {@inheritDoc}
     */
    protected function getShippingAddress($customer)
    {
        $shipping = Shipping::getFromShoppingCart();

        return $shipping ? $customer->addShipping($shipping)->id  : null;
    }

    /**
     * {@inheritDoc}
     */
    protected function getAddress()
    {
        return Customer::createFromShoppingCart();
    }
}
