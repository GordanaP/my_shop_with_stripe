<?php

namespace App\Services\Actions;

use App\Customer;
use App\Shipping;
use App\Services\Actions\CompleteOrder;

class RecordGuestPurchase
{
    /**
     * Handle the guest's purchase.
     *
     * @param  string $paymentIntent
     * @return void
     */
    public function handle($paymentIntent)
    {
        $customer = $this->getBillingAddress();

        $shipping = $this->getShippingAddress($customer);

        $order = (new CompleteOrder)->handle($shipping, $paymentIntent);

        $customer->placeOrder($order);
    }

    /**
     * Get the billing address.
     *
     * @return \App\Customer
     */
    protected function getBillingAddress()
    {
        return Customer::createFromShoppingCart();
    }

    /**
     * Get the shipping address.
     *
     * @param  \App\Customer $customer
     * @return integer
     */
    protected function getShippingAddress($customer)
    {
        $shipping = Shipping::getFromShoppingCart();

        return $shipping ? $customer->addShipping($shipping)->id  : null;
    }
}
