<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use App\Customer;
use App\Shipping;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    // public function index(User $user = null)
    // {
    //     return view('checkouts.index')->with([
    //         'user' => $user ?? '',
    //         'selected_delivery' => optional($user)->getDefaultAddress()
    //     ]);
    // }

    // public function store(Request $request, User $user = null, Shipping $shipping = null)
    // {
    //     return $user ?? 'no shipping';

    //     // $billingAddress = ShoppingCart::fromSession()->getOwner('address', 'billing');
    //     // $shippingAddress = ShoppingCart::fromSession()->getOwner('address', 'shipping');

    //     // if ($billingAddress->isNotEmpty()) {

    //     //     $customer = $user ? optional($user)->addCustomer($billingAddress->toArray())
    //     //           : Customer::create($billingAddress->toArray());
    //     // }
    //     // else
    //     // {
    //     //     $customer = $user->customer;
    //     // }

    //     // if ($shippingAddress->isNotEmpty()) {

    //     //     $shipping = $customer->addShipping($shippingAddress->toArray());
    //     // }

    //     // Session::forget('address');

    //     // return response([
    //     //     'message' => 'success',
    //     //     'redirectToUrl' => route('checkouts.success')
    //     // ]);
    // }
}
