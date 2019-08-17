<?php

namespace App\Http\Controllers\Checkout\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\CompletePurchaseAction;

class CheckoutGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkouts.guests.index');
    }

    public function store(Request $request)
    {
        $paymentIntent = '123457';

        return (new CompletePurchaseAction())->execute($paymentIntent);
    }

}
