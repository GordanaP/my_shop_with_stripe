<?php

namespace App\Http\Controllers\Shipping;

use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        return view('shippings.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Shipping $shipping)
    {
        $shipping->updateData($request->validated());

        return redirect()->route('users.shippings.index', $shipping->registered_customer->user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        $shipping->delete();

        return response([
            'message' => 'The address has been deleted!'
        ]);
    }
}
