<?php

namespace App\Services\Actions;

use App\User;
use App\Services\Actions\CompleteOrder;

class RecordCustomerPurchase
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle($paymentIntent)
    {
        $customer = $this->user->customer;
        $shippingId = $this->getShippingId();

        return (new CompleteOrder($customer, $shippingId))->handle($paymentIntent);
    }

    protected function getShippingId()
    {
        $address = collect(request('address'));

        return $address->has('customer_id') ? $address->get('id') : null;
    }
}