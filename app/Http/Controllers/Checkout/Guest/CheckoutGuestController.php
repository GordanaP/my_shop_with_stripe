<?php

namespace App\Http\Controllers\Checkout\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\CompleteOrderInfoAction;

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
        return (new CompleteOrderInfoAction())->execute();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $paymentIntent = '1234567';

    //     // $order = (new CompleteOrderShippingAction($this->getCustomer()))->execute();
    //     $order = (new CompleteOrderShippingAction())->execute();

    //     $order->completePayment($paymentIntent);

    //     $this->getCustomer()->placeOrder($order);

    //     return response([
    //         'message' => 'success'
    //     ]);
    // }
    //
}
