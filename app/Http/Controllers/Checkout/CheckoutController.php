<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use App\Customer;
use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(User $user = null)
    {
        return view('checkouts.index')->with([
            'user' => $user ?? ''
        ]);
    }

    public function store(Request $request, User $user = null)
    {
        $billingAddress = Session::get('address')->get('billing');
        $shippingAddress = Session::get('address')->get('shipping');

        if ($billingAddress->isNotEmpty()) {

            $customer = $user ? optional($user)->addCustomer($billingAddress->toArray())
                  : Customer::create($billingAddress->toArray());
        }

        if ($shippingAddress->isNotEmpty()) {

            $customer->addShipping($shippingAddress->toArray());
        }

        Session::forget('address');

        return response([
            'message' => 'success',
            'redirectToUrl' => route('checkouts.success')
        ]);
    }
}
