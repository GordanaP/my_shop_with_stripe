<?php

namespace App\Services\Factories;

use App\User;
use App\Services\Actions\UserPurchase;
use App\Services\Actions\GuestPurchase;
use App\Services\Actions\CustomerPurchase;

class PurchaseFactory
{
    /**
     * Create the purchase.
     *
     * @param  \App\User $user
     * @param  string $payment
     * @return mixed
     */
    public function create($user, $payment)
    {
        if(! $user)
        {
            return (new GuestPurchase($payment));
        }

        if(! $user->hasProfile())
        {
            return (new UserPurchase($user, $payment));
        }

        return (new CustomerPurchase($user, $payment));
    }
}