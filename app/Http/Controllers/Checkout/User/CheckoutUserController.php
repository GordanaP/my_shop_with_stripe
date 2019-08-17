<?php

namespace App\Http\Controllers\Checkout\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\CompletePurchaseAction;
use App\Actions\CompleteOrderInfoAction;

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

    public function store(Request $request, User $user)
    {
        return (new CompleteOrderInfoAction($user))->execute();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request, User $user)
    // {
    //     $paymentIntent = '1234567';

    //     // $order = (new CompleteOrderShippingAction($user->customer))->execute();
    //     $order = (new CompleteOrderShippingAction($user))->execute();

    //     $order->completePayment($paymentIntent);

    //     $user->customer->placeOrder($order);

    //     return response([
    //         'message' => 'success'
    //     ]);
    // }
    //
}
