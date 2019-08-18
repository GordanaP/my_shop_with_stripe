<?php

namespace App\Services\Actions;

use App\User;
use App\Traits\Order\Completable;

class RecordCustomerPurchase
{
    use Completable;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle($paymentIntent)
    {
        $order = $this->completeOrder($this->getShipping(), $paymentIntent);

        return $this->user->customer->placeOrder($order);
    }

    protected function getShipping()
    {
        $address = collect(request('address'));

        return $address->has('customer_id') ? $address->get('id') : null;
    }
}