<?php

namespace App\Services\Actions;

use App\Order;
use App\Customer;

class PlaceOrder
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
     * @return void
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
     * @return \App\Order
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
     * @return \App\Order $order
     */
    public function getOrder($shipping, $payment)
    {
        return Order::fromShoppingCart()
            ->completeShipping($shipping)
            ->completePayment($payment);
    }
}