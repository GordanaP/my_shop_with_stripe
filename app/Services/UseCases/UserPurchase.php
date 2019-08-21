<?php

namespace App\Services\UseCases;

use App\User;
use App\Services\Actions\PlaceOrder;
use App\Services\AbstractClasses\Purchase;

class UserPurchase extends Purchase
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
        $customer = $this->getAddress()->get('billing');

        return $this->user->addCustomer($customer);
    }

    /**
     * {@inheritDoc}
     */
    protected function getShippingAddress($customer)
    {
        $shipping = $this->getAddress()->get('shipping');

        return $this->getAddress()->has('shipping') ? $customer->addShipping($shipping)->id : null;
    }

    /**
     * {@inheritDoc}
     */
    protected function getAddress()
    {
        return collect(request('address'));
    }
}
