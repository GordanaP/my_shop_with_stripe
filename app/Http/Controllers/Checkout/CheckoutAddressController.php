<?php

namespace App\Http\Controllers\Checkout;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CheckoutAddressRequest;

class CheckoutAddressController extends Controller
{
    /**
     * Store the checkout adresses into a session.
     *
     * @return void
     */
    public function __invoke(CheckoutAddressRequest $request)
    {
        $address = collect(['billing' => collect($request->billing)]);

        $billing = Session::put('address', $address);
    }
}
