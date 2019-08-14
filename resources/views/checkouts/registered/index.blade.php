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
                <section class="addresses-info w-4/5">
                    <div class="billing-address">
                        @include('checkouts.partials.html._registered_address', [
                            'title' => 'Billing address',
                            'route' => route('customers.edit', $user->customer),
                            'default_delivery' => '',
                            'customer' => $user->customer,
                        ])
                    </div>

                    <div class="shipping-address mt-8">
                        @include('checkouts.partials.html._registered_address', [
                            'title' => 'Shipping address',
                            'route' => route('users.select.delivery', $user),
                            'customer' => $shipping ?: ($default_delivery ?: $user->customer),
                        ])
                    </div>
                </section>
            </div>

            <div class="col-md-6">
                <section id="order-info">
                    <p class="font-bold">My Order</p>
                </section>

                <section id="payment-info">
                    <p class="font-bold">Payment Info</p>

                    <button type="button" class="btn btn-primary" id="checkoutButton">
                        Checkout
                    </button>
                </section>
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </form>

@endsection

@section('scripts')
    <script>


        clearServerSideErrorOnNewInput();

        var registeredCustomer = @json(optional($user)->hasProfile());

        var currentRoute = "{{ Route::currentRouteName() }}"

        var checkoutButton = document.querySelector('#checkoutButton');
        var checkoutAddressStoreUrl = "{{ route('checkouts.addresses.store') }}";
        {{-- var usersCheckoutStoreUrl = "{{ route('users.checkouts.store', $user ?? '') }}"; --}}

        var shippingAddress = "{{ route('checkout.registered.users.store', [$user, optional($user)->isNotBillingAddress($default_delivery) ? $default_delivery : '']) }}";


        @if (Auth::user())
            var usersCheckoutStoreUrl = "{{ route('checkout.registered.users.store', [$user, optional($user)->isNotBillingAddress($default_delivery) ? $default_delivery : '']) }}";
        @else
            var usersCheckoutStoreUrl =  "{{ route('checkout.guests.store') }}";
        @endif

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
                        console.log(result)

                        // redirectTo(result.redirectToUrl)
                    }
                });
            });
        });

    </script>
@endsection