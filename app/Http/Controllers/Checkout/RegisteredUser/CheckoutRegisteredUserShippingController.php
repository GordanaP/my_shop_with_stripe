<?php

namespace App\Http\Controllers\Checkout\RegisteredUser;

use App\User;
use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutRegisteredUserShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Shipping $shipping = null)
    {
        return view('checkouts.registered.index')->with([
            'user' => $user,
            'shipping' => $shipping ?: $user->customer,
            'default_delivery' => '',
        ]);
    }
}
