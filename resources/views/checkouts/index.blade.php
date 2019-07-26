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
                        @if (optional($user)->hasProfile())
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
                        @endif
                    </p>

                    <div class="card card-body">
                        @if (optional($user)->hasProfile())
                            @include('customers.html._profile_details', [
                                'customer' => $user->customer
                            ])
                        @else
                            @include('checkouts.partials.forms._add_address', [
                                'address' => 'billing'
                            ])
                        @endif
                    </div>
                </div>

                <div id="shippingAddress" class="w-4/5 hidden mt-3">
                    <p class="font-medium">Shipping Address</p>

                    <div class="card card-body">
                        @include('checkouts.partials.forms._add_address', [
                            'address' => 'shipping'
                        ])
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
        var hiddenField = document.querySelector('#shippingAddress');
        var toggleHiddenFieldCheckbox = document.querySelector('#toggleShippingAddress');

        var checkoutAddressStoreUrl = "{{ route('checkouts.addresses.store') }}";
        var usersCheckoutStoreUrl = "{{ route('users.checkouts.store', $user ?? '') }}";

        var billingAddress = 'billing';
        var shippingAddress = 'shipping';
        var addressFields = [
            'first_name', 'last_name', 'street_address', 'postal_code', 'city',
            'country', 'phone', 'email'
        ];

        if(toggleHiddenFieldCheckbox)
        {
            toggleHiddenFieldCheckbox.addEventListener('change', function(event) {
                if ( ! event.target.checked) {
                    clearHiddenServerSideErrorsPureJS(hiddenField)
                }
            });
        }

        checkoutButton.addEventListener('click', function() {

            clearServerSideErrors()

            $.ajax({
                url: checkoutAddressStoreUrl,
                method: "POST",
                data: registeredCustomer ? ''
                        : getCheckedAddress(toggleHiddenFieldCheckbox, billingAddress, shippingAddress, addressFields),
                success: function(response) {
                    console.log(response)
                    clearFormFields()
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    displayServerSideErrors(errors)
                }
            })
            // .then(function() {
            //     $.ajax({
            //         url: usersCheckoutStoreUrl,
            //         method: 'POST',
            //         success: function(result)
            //         {
            //             console.log(result.message)

            //             redirectTo(result.redirectToUrl)
            //         }
            //     });
            // });
        });

    </script>
@endsection