<?php

namespace App\Http\Controllers\Checkout\Confirmation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutSuccessController extends Controller
{
    public function __invoke()
    {
        return view('checkouts.confirmations.success');
    }
}
