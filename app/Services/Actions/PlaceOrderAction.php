<?php

namespace App\Services\Actions;

use App\Order;
use App\Customer;

class PlaceOrderAction
{
    /**
     * The customer.
     *
     * @var \App\Customer
     */
    public $customer;

    /**
     * Create a new class instance.
     *
     * @param  Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Complete the order.
     *
     * @param  int $shipping
     * @param  string $payment
     * @return  \App\Order
     */
    public function complete($shipping, $payment)
    {
        $order = $this->getOrder($shipping, $payment);

        return $this->customer->placeOrder($order);
    }

    /**
     * Get the order.
     *
     * @param  int $shipping
     * @param  string $payment
     * @return \App\Order
     */
    protected function getOrder($shipping, $payment)
    {
        return Order::getFromShoppingCart()
            ->completeShipping($shipping)
            ->completePayment($payment);
    }
}
