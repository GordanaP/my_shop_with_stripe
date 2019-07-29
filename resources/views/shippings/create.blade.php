@extends('layouts.app')

@section('title', 'Create Shipping Address')

@section('content')

    <div class="card w-4/5 mx-auto">
        <header class="border-b border-b-gray-500 p-3 text-xl uppercase">
            Create address
        </header>

        <div class="p-3 text-sm font-light">
            All fields marked with * are required.
        </div>

        <div class="card-body mx-auto w-3/4">
            @include('customers.partials.forms._save', [
                'route' => route('users.shippings.store', Auth::user()),
                'first_name' => old('first_name'),
                'last_name' => old('last_name'),
                'street_address' => old('street_address'),
                'postal_code' => old('postal_code'),
                'city' => old('city'),
                'country_code' => old('country'),
                'phone' => old('phone'),
                'button_name' => 'Create Address',
            ])
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        clearServerSideErrorOnNewInput()

    </script>
@endsection