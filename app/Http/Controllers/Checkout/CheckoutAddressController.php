<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use App\Shipping;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutAddressRequest;

class CheckoutAddressController extends Controller
{
    /**
     * Store the checkout adresses into a session.
     *
     * @param \App\Http\Requests\CheckoutAddressRequest $request
     * @return void
     */
    public function store(CheckoutAddressRequest $request)
    {
        $billing = collect(['billing' => collect($request->billing)]);
        $shipping = collect(['shipping' => collect($request->shipping)]);

        $address = $billing->union($shipping);

        ShoppingCart::fromSession()->complete($address);
    }

    public function show(User $user, Shipping $shipping = null)
    {
        return view('checkouts.index')->with([
            'user' => $user,
            'selected_delivery' => $shipping ?: $user->customer
        ]);
    }
}
