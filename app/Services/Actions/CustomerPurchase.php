<?php

namespace App\Services\Actions;

use App\User;
use App\Interfaces\Purchase;
use App\Services\Actions\PlaceOrder;

class CustomerPurchase implements Purchase
{
    /**
     * The user.
     *
     * @var \App\User
     */
    public $user;

    /**
     * The payment
     * @var string
     */
    public $payment;

    /**
     * Create a new class instance.
     *
     * @param \App\User $user
     * @param string $payment
     * @return void
     */
    public function __construct(User $user, $payment)
    {
        $this->user = $user;
        $this->payment = $payment;
    }

    /**
     * Handle the registered customer's purchase.
     *
     * @return void
     */
    public function handle()
    {
        $customer = $this->getBillingAddress($this->user);

        $shipping = $this->getShippingAddress();

        (new PlaceOrder($customer))->complete($shipping, $this->payment);
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
