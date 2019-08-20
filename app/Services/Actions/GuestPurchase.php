<?php

namespace App\Services\Actions;

use App\Customer;
use App\Shipping;
use App\Interfaces\Purchase;
use App\Services\Actions\PlaceOrder;

class GuestPurchase implements Purchase
{
    /**
     * The payment.
     *
     * @var string
     */
    public $payment;

    /**
     * Create a new class instance.
     *
     * @param string $payment
     * @return void
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Handle the guest's purchase.
     *
     * @return void
     */
    public function handle()
    {
        $customer = $this->getBillingAddress();

        $shipping = $this->getShippingAddress($customer);

        (new PlaceOrder($customer))->complete($shipping, $this->payment);
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
