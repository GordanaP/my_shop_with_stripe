<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use App\Customer;
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
        $billing = Session::get('address')->get('billing');

        if ($billing->isNotEmpty()) {
            $user ? optional($user)->addCustomer($billing->toArray())
                  : Customer::create($billing->toArray());

            Session::forget('address');
        }

        return response([
            'message' => 'success',
            'redirectToUrl' => route('checkouts.success')
        ]);
    }
}
