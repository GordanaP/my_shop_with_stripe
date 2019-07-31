<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerRequest;
use RealRashid\SweetAlert\Facades\Alert;

class UserShippingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('shippings.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('shippings.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request, User $user)
    {
        $user->customer->addShipping($request->validated());

        Alert::success('Success!', 'The address has been added to the address book.');

        return redirect()->route('users.shippings.index', Auth::user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Shipping $shipping)
    {
        $user->changeDefaultAddress($shipping);

        Alert::success('Success!', 'The default address is changed.');

        return back();
    }
}
