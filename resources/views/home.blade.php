@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <header>
        <h2>Hi {{ optional(Auth::user()->customer)->full_name ?: Auth::user()->name }}</h2>
        <hr>
    </header>

    <div class="row">
        <div class="col-md-4">
            @settings
                @slot('icon') lock
                @endslot
                @slot('title') My Account
                @endslot
                @slot('details')
                    <p class="mb-1">{{ Auth::user()->name }}</p>
                    <p>{{ Auth::user()->email }}</p>
                @endslot
                @slot('edit_route') {{ route('users.edit', Auth::user()) }}
                @endslot

                @include('users.forms._delete')
            @endsettings
        </div>

        <div class="col-md-4">
            @if (Auth::user()->hasProfile())
                @settings
                    @slot('icon') user
                    @endslot
                    @slot('title') My Profile
                    @endslot
                    @slot('details')
                        <p class="uppercase font-bold mb-0">
                            {{ Auth::user()->customer->full_name }}
                        </p>
                        <p class="mb-0">{{ Auth::user()->customer->street_address }}</p>
                        <p class="mb-0">{{ Auth::user()->customer->postal_code }}
                            {{ Auth::user()->customer->city }}</p>
                        <p class="mb-0">
                            {{ Country::getName(Auth::user()->customer->country) }}
                        </p>
                        <p class="mb-0">{{ Auth::user()->customer->phone }}</p>
                    @endslot
                    @slot('edit_route') {{ route('customers.edit', Auth::user()->customer) }}
                    @endslot

                    @include('customers.forms._delete')
                @endsettings
            @else
                <a href="{{ route('users.customers.create', Auth::user()) }}"
                class="font-bold" style="color: inherit; text-decoration: none">
                    <div class="card" style="height: 350px">
                        <div class="my-auto text-2xl">
                            <p class="text-center mb-1"><i class="fa fa-plus text-gray-500"></i></p>
                            <p class="text-center">Add Profile</p>
                        </div>
                    </div>
                </a>
            @endif
        </div>

        <div class="col-md-4">
            <a href="#"
            class="font-bold" style="color: inherit; text-decoration: none">
                <div class="card" style="height: 350px">
                    <div class="my-auto text-2xl">
                        <p class="text-center mb-1"><i class="fa fa-plus text-gray-500"></i></p>
                        <p class="text-center">Add Shipping Address</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        var deleteAccountButton = $('#deleteAccountButton');
        var deleteAccountUrl = "{{ route('users.destroy', Auth::user()) }}";
        var redirectAfterDeleteAccount = "{{ route('welcome') }}";

        deleteAccountButton.on('click', function(){
            swalConfirmDelete(deleteAccountUrl, redirectAfterDeleteAccount);
        });

        var deleteCustomerButton = $('#deleteCustomerButton');
        var deleteCustomerUrl = "{{ route('customers.destroy', Auth::user()) }}";
        var redirectAfterDeleteCustomer = "{{ route('home') }}";

        deleteCustomerButton.on('click', function(){
            swalConfirmDelete(deleteCustomerUrl, redirectAfterDeleteCustomer);
        });

    </script>
@endsection