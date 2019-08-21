<?php

namespace App\Services\Factories;

use App\User;
use App\Services\UseCases\UserPurchase;
use App\Services\UseCases\GuestPurchase;
use App\Services\UseCases\CustomerPurchase;

class PurchaseFactory
{
    /**
     * Create the purchase.
     *
     * @param  \App\User $user
     * @param  string $payment
     * @return mixed
     */
    public function createPurchase(User $user = null, $payment)
    {
        if(! $user) {
            return new GuestPurchase($payment);
        }

        if(! $user->hasProfile()) {
            return new UserPurchase($user, $payment);
        }

        return new CustomerPurchase($user, $payment);
    }
}
