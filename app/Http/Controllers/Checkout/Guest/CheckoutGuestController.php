<?php

namespace App\Http\Controllers\Checkout\Guest;

use App\Http\Controllers\Controller;

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
}
