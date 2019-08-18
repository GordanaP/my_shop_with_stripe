<?php

namespace App\Services\Actions;

use App\User;
use App\Services\Actions\CompleteOrder;


class RecordUserPurchase
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle($paymentIntent)
    {
        $customer = $this->createCustomer($this->user);
        $shippingId = $this->getShippingId($customer);

        return (new CompleteOrder($customer, $shippingId))->handle($paymentIntent);
    }

    protected function createCustomer($user)
    {
        $customer = $this->address()->get('billing');

        return $user->addCustomer($customer);
    }

    protected function getShippingId($customer)
    {
        $shipping = $this->address()->get('shipping');

        return $this->address()->has('shipping') ? $customer->addShipping($shipping)->id : null;
    }

    protected function address()
    {
        return collect(request('address'));
    }

}