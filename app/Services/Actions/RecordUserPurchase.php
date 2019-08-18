<?php

namespace App\Services\Actions;

use App\User;
use App\Traits\Order\Completable;


class RecordUserPurchase
{
    use Completable;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle($paymentIntent)
    {
        $customer = $this->createCustomer($this->user);

        $order = $this->completeOrder($this->getShipping($customer), $paymentIntent);

        return $customer->placeOrder($order);
    }

    protected function createCustomer($user)
    {
        $customer = $this->address()->get('billing');

        return $user->addCustomer($customer);
    }

    protected function getShipping($customer)
    {
        $shipping = $this->address()->get('shipping');

        return $this->address()->has('shipping') ? $customer->addShipping($shipping)->id : null;
    }

    protected function address()
    {
        return collect(request('address'));
    }

}