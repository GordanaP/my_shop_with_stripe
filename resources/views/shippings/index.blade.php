@extends('layouts.app')

@section('title', 'Address Book')

@section('content')
    <header>
        <div  class="flex justify-between items-center">
            <h2 class="mb-0">My Address Book</h2>

            <a href="{{ route('users.shippings.create', Auth::user()) }}"
            class="bg-blue-300 hover:bg-blue-400 px-2 py-1 text-white text-base rounded-sm pull-right no-underline">
                <i class="fa fa-plus fa-lg mr-1" aria-hidden="true"></i> Add Address
            </a>
        </div>
        <hr>
    </header>

    <main>
        @foreach (Auth::user()->getAddressBook()->chunk(3) as $chunk)
            <div class="row">
                @foreach ($chunk as $shipping)
                    <div class="col-md-4">
                        @include('shippings.partials.html._show_address', [
                            'customer' => $shipping,
                            'edit_customer' => route('customers.edit', Auth::user()->customer),
                            'edit_shipping' => route('shippings.edit', $shipping),
                        ])
                    </div>
                @endforeach
            </div>
        @endforeach
    </main>
@endsection
