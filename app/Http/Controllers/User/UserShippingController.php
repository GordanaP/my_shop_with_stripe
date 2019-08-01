<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;

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
        $this->authorize('view', $user);

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
        $this->authorize('create', Shipping::class);
        $this->authorize('view', $user);

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
        $this->authorize('create', Shipping::class);
        $this->authorize('view', $user);

        $user->customer->addShipping($request->validated());

        return redirect()->route('users.shippings.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Shipping $shipping = null)
    {
        $this->authorize('view', $user);

        $shipping ? $this->authorize('update', $shipping) : '';

        $user->setNewDefaultAddress($shipping);

        return back();
    }
}
