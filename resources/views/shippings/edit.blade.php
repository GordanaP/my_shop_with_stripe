@extends('layouts.app')

@section('title', 'Edit Address')

@section('content')
    <div class="card w-4/5 mx-auto">
        <header class="border-b border-b-gray-500 p-3 text-xl uppercase">
            Edit address
        </header>

        <div class="p-3 text-sm font-light">
            All fields marked with * are required.
        </div>

        <div class="card-body mx-auto w-3/4">
            @include('customers.partials.forms._save', [
                'route' => route('shippings.update', $shipping),
                'first_name' => old('first_name') ?? $shipping->first_name,
                'last_name' => old('last_name') ?? $shipping->last_name,
                'street_address' => old('street_address') ?? $shipping->street_address,
                'postal_code' => old('postal_code') ?? $shipping->postal_code,
                'city' => old('city') ?? $shipping->city,
                'country_code' => old('country') ?? $shipping->country,
                'phone' => old('phone') ?? $shipping->phone,
                'default_address' => old('default_address') ?? $shipping->default_address,
                'button_name' => 'Update Address',
            ])
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        clearServerSideErrorOnNewInput()

    </script>
@endsection