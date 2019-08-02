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
                <section id="checkoutAddresses">

                    <div id="billingAddress" class="w-4/5">
                        @include('checkouts.partials.html._billing_address')
                    </div>

                    <div id="shippingAddress" class="w-4/5 @withProfile($user) @else hidden @endwithProfile mt-3">
                        @include('checkouts.partials.html._shipping_address')
                    </div>
                </section>
            </div>

            <div class="col-md-6">
                <section id="OrderDetails">
                    <p class="font-bold">My Order</p>
                </section>

                <section id="paymentInfo">
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