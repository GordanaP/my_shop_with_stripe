<?php

namespace App\Http\Controllers\Checkout\Guest;

// use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutAddressRequest;

class CheckoutGuestAddressController extends Controller
{
    /**
     * Store the guest's address into the shopping cart.
     *
     * @param  \App\Http\Requests\CheckoutAddressRequest $request
     * @return void
     */
    public function __invoke(CheckoutAddressRequest $request)
    {
        $billing = collect(['billing' => collect($request->billing)]);
        $shipping = collect(['shipping' => collect($request->shipping)]);

        $address = $billing->union($shipping);

        ShoppingCart::fromSession()->complete($address);
    }
}
