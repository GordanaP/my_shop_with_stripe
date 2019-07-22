<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerRequest;
use RealRashid\SweetAlert\Facades\Alert;

class UserCustomerController extends Controller
{
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

        Alert::success('Success!', 'Your profile has been created.');

        return redirect()->route('home');
    }
}
