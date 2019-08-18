<?php

namespace App\Http\Controllers\Checkout\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('checkouts.customers.index')->with([
            'user' => $user,
            'default_delivery' => $user->getDefaultAddress(),
            'shipping' => ''
        ]);
    }
}
