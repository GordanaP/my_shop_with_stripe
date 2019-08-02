@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <header>
        <h1>Checkout</h1>
        <hr>
    </header>

    <form id="checkoutForm">
        <div class="row">
            <div class="col-md-6">
                <div id="billingAddress" class="w-4/5">
                    <p>
                        <span class="font-bold">Billing Address</span>

                        @withProfile($user)
                            <a href="{{ route('customers.edit', $user->customer) }}" class="ml-1">
                                Change
                            </a>
                        @else
                            <span class="pull-right">
                                <input id="toggleShippingAddress" type="checkbox" class="form-check-input"
                                    onclick="toggleHiddenFieldVisibility('#shippingAddress')" />
                                <label class="form-check-label font-normal" for="toggleShippingAddress">
                                    Different shipping address
                                </label>
                            </span>
                        @endwithProfile
                    </p>

                    <div class="card card-body">
                        <p class="uppercase mb-1">{{ optional(optional($user)->customer)->full_name }}</p>

                        @withProfile($user)
                            @include('customers.partials.html._show_details', [
                                'customer' => $user->customer
                            ])
                        @else
                            @include('checkouts.partials.forms._add_address', [
                                'address' => 'billing'
                            ])
                        @endwithProfile
                    </div>
                </div>

                <div id="shippingAddress" class="w-4/5 @withProfile($user) @else hidden @endwithProfile mt-3">
                    <p class="font-medium">
                        Shipping Address
                        @withProfile($user)
                            <a href="{{ route('users.select.delivery', $user) }}" class="ml-1">
                                Change
                            </a>
                        @endwithProfile
                    </p>

                    <div class="card card-body">
                        @withProfile($user)
                            <p class="uppercase mb-1">

                                {{ $selected_delivery->full_name }}

                                @if (optional($selected_delivery)->is_default)
                                    <span class="bg-orange-400 text-xs px-2 py-1 rounded-lg text-white">
                                        Default
                                    </span>
                                @endif
                            </p>
                            @include('customers.partials.html._show_details', [
                                'customer' => $user->getDefaultAddress()
                            ])
                        @else
                            @include('checkouts.partials.forms._add_address', [
                                'address' => 'shipping'
                            ])
                        @endwithProfile
                    </div>
                </div>
            </div><!-- /.col-md-6 -->

            <div class="col-md-6">
                <p class="font-bold">My Order</p>

                <p class="font-bold">Payment Info</p>

                <button type="button" class="btn btn-primary" id="checkoutButton">
                    Checkout
                </button>
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </form>

@endsection

@section('scripts')
    <script>

        clearServerSideErrorOnNewInput();

        var registeredCustomer = @json(optional($user)->hasProfile())

        var checkoutButton = document.querySelector('#checkoutButton');

        var checkoutAddressStoreUrl = "{{ route('checkouts.addresses.store') }}";
        var usersCheckoutStoreUrl = "{{ route('users.checkouts.store', $user ?? '') }}";

        var hiddenAddress = document.querySelector('#shippingAddress');
        var toggleHiddenAddressCheckbox = document.querySelector('#toggleShippingAddress');
        var billing = 'billing';
        var shipping = 'shipping';
        var addressFields = [
            'first_name', 'last_name', 'street_address', 'postal_code', 'city',
            'country', 'phone', 'email'
        ];

        // Remove errors after hiding the hidden address form
        if(toggleHiddenAddressCheckbox)
        {
            toggleHiddenAddressCheckbox.addEventListener('change', function(event) {
                if ( ! event.target.checked) {
                    clearHiddenServerSideErrorsPureJS(hiddenAddress)
                }
            });
        }

        checkoutButton.addEventListener('click', function() {

            clearServerSideErrors()

            $.ajax({
                url: checkoutAddressStoreUrl,
                method: "POST",
                data: registeredCustomer ? ''
                        : getCheckedAddress(toggleHiddenAddressCheckbox, billing, shipping, addressFields),
                success: function(response) {
                    console.log(response)
                    clearFormFields()
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    displayServerSideErrors(errors)
                }
            })
            .then(function() {
                $.ajax({
                    url: usersCheckoutStoreUrl,
                    method: 'POST',
                    success: function(result)
                    {
                        console.log(result.message)

                        redirectTo(result.redirectToUrl)
                    }
                });
            });
        });

    </script>
@endsection