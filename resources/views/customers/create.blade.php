@extends('layouts.app')

@section('title', 'Create Profile')

@section('content')
    <div class="card w-4/5 mx-auto">
        <div class="border-b border-b-gray-500 p-3 text-xl uppercase">
            Create profile
        </div>

        <div class="px-3 pt-3 text-sm font-light">
            All fields marked with * are required.
        </div>

        <div class="card-body mx-auto w-3/4">
            @include('customers.forms._save', [
                'route' => route('users.customers.store', Auth::user()),
                'first_name' => old('first_name'),
                'last_name' => old('last_name'),
                'street_address' => old('street_address'),
                'postal_code' => old('postal_code'),
                'city' => old('city'),
                'country_code' => old('country'),
                'phone' => old('phone'),
                'button_name' => 'Create Profile',
            ])
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        clearServerSideErrorOnNewInput()

    </script>
@endsection