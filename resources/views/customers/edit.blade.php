@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

    <div class="card w-4/5 mx-auto">
        <div class="border-b border-b-gray-500 p-3 text-xl uppercase">
            Edit profile
        </div>

        <div class="px-3 pt-3 text-sm font-light">
            All fields marked with * are required.
        </div>

        <div class="card-body mx-auto w-3/4">
            @include('customers.forms._save', [
                'route' => route('customers.update', $customer),
                'first_name' => old('first_name') ?: $customer->first_name,
                'last_name' => old('last_name') ?: $customer->last_name,
                'street_address' => old('street_address') ?: $customer->street_address,
                'postal_code' => old('postal_code') ?: $customer->postal_code,
                'city' => old('city') ?: $customer->city,
                'country_code' => old('country') ?: $customer->country,
                'phone' => old('phone') ?: $customer->phone,
                'button_name' => 'Update Profile',
            ])
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        clearServerSideErrorOnNewInput()

    </script>
@endsection