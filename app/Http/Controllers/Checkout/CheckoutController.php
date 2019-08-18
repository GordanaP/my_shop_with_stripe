<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Actions\RecordUserPurchase;
use App\Services\Actions\RecordGuestPurchase;
use App\Services\Actions\RecordCustomerPurchase;

class CheckoutController extends Controller
{
    public function store(Request $request, User $user = null)
    {
        $paymentIntent = '1234567';

        return $this->recordPurchases($user)->handle($paymentIntent);
    }

    protected function recordPurchases($user = null)
    {
        if(! $user)
        {
            return new RecordGuestPurchase();
        }

        if(! $user->hasProfile())
        {
            return new RecordUserPurchase($user);
        }

        return new RecordCustomerPurchase($user);
    }
}
