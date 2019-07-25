<?php

namespace App\Http\Controllers\Checkout;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkouts.index');
    }

    public function store(Request $request)
    {
        $billing = Session::get('address')->get('billing')->toArray();

        $customer = Customer::create($billing);

        Session::flush();

        return response([
            'message' => 'success',
            'redirectToUrl' => route('checkouts.index')
        ]);
    }
}
