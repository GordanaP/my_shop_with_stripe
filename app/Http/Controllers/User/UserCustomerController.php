<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;

class UserCustomerController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $this->authorize('view', $user);
        $this->authorize('create', Customer::class);

        return view('customers.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request, User $user)
    {
        $this->authorize('view', $user);
        $this->authorize('create', Customer::class);

        $user->addCustomer($request->validated());

        return redirect()->route('home');
    }
}
