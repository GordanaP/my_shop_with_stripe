<?php

namespace App\Services\AbstractClasses;

use App\Order;
use App\Services\Actions\PlaceOrderAction;

abstract class Purchase
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
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    /**
     * Handle the purchase.
     *
     * @return \App\Order
     */
    final public function handle()
    {
        $customer = $this->getBillingAddress();
        $shipping = $this->getShippingAddress($customer);

        return (new PlaceOrderAction($customer))->complete($shipping, $this->payment);
    }

    /**
     * Get the billing address.
     *
     * @return  \App\Customer
     */
    abstract protected function getBillingAddress();

    /**
     * Get the shipping address.
     *
     * @param  \App\Customer $customer
     * @return int|null
     */
    abstract protected function getShippingAddress($customer);

    /**
     * Get the address.
     *
     * @return  mixed
     */
    abstract protected function getAddress();
}
