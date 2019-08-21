<?php

namespace App\Services\UseCases;

use App\User;
use App\Services\AbstractClasses\Purchase;

class CustomerPurchase extends Purchase
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
     * @param string $payment
     */
    public function __construct(User $user, $payment)
    {
        $this->user = $user;

        parent::__construct($payment);
    }

    /**
     * {@inheritDoc}
     */
    protected function getBillingAddress()
    {
        return $this->user->customer;
    }

    /**
     * {@inheritDoc}
     */
    protected function getShippingAddress($customer = null)
    {
        $address = $this->getAddress();

        return $address->has('customer_id') ? $address->get('id') : null;
    }

    /**
     * {@inheritDoc}
     */
    protected function getAddress()
    {
        return collect(request('address'));
    }
}
