<?php

namespace App\Http\Controllers\Checkout\Guest;

use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;

class CheckoutGuestAddressController extends Controller
{
    public function __invoke(Request $request)
    {
        $billing = collect(['billing' => collect($request->billing)]);
        $shipping = collect(['shipping' => collect($request->shipping)]);

        $address = $billing->union($shipping);

        ShoppingCart::fromSession()->complete($address);
    }
}
