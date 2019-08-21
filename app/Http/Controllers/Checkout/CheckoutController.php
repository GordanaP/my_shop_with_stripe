<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Factories\PurchaseFactory;
use App\Http\Requests\CheckoutAddressRequest;

class CheckoutController extends Controller
{
    /**
     * Store a newly created purchase in storage.
     *
     * @param  \App\Http\Requests\CheckoutAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user = null)
    {
        $payment = '1234567';

        (new PurchaseFactory)->createPurchase($user, $payment)->handle();

        return response([
            'redirectTo' => route('checkout.confirm.success')
        ]);
    }
}
