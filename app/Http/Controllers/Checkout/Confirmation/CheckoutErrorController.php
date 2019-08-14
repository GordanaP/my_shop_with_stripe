<?php

namespace App\Http\Controllers\Checkout\Confirmation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutErrorController extends Controller
{
    public function __invoke()
    {
        return view('checkouts.confirmations.error');
    }
}
