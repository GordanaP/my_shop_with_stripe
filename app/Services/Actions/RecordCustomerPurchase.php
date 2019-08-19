<?php

namespace App\Services\Actions;

use App\User;
use App\Services\Actions\CompleteOrder;

class RecordCustomerPurchase
{
    /**
     * The user.
     *
     * @var \App\User
     */
    public $user;

    /**
     * Create a new class instance.
     *
     * @param \App\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the registered customer's purchase.
     *
     * @param  string $paymentIntent
     * @return void
     */
    public function handle($paymentIntent)
    {
        $customer = $this->getBillingAddress($this->user);

        $shipping = $this->getShippingAddress();

        $order = (new CompleteOrder)->handle($shipping, $paymentIntent);

        $customer->placeOrder($order);
    }

    /**
     * Get the billing address;
     *
     * @param  \App\User $user
     * @return \App\Customer
     */
    protected function getBillingAddress($user)
    {
        return $user->customer;
    }

    /**
     * Get the shipping address.
     *
     * @return integer
     */
    protected function getShippingAddress()
    {
        $address = collect(request('address'));

        return $address->has('customer_id') ? $address->get('id') : null;
    }
}
