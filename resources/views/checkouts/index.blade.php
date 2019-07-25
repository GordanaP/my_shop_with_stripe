@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

    <header>
        <h1>Checkout</h1>
        <hr>
    </header>
{{-- {{ Session::flush() }} --}}
{{ Session::get('address') }}
    <form id="checkoutForm">
        <div class="row">
            <div class="col-md-6">
                <p class="font-bold">Billing Address</p>

                <div class="w-4/5 card card-body">

                        @include('checkouts.partials.forms._add_address', [
                            'address' => 'billing'
                        ])
                </div>
            </div>

            <div class="col-md-6">
                <p class="font-bold">My Order</p>

                <p class="font-bold">Payment Info</p>

                <button type="button" class="btn btn-primary" id="checkoutButton">
                    Checkout
                </button>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
    <script>

        clearServerSideErrorOnNewInput()

        var checkoutButton = document.querySelector('#checkoutButton');
        var checkoutAddressStoreUrl = "{{ route('checkouts.addresses.store') }}";
        var checkoutStoreUrl = "{{ route('checkouts.store') }}";

        var billingAddress = 'billing';
        var addressFields = [
            'first_name', 'last_name', 'street_address', 'postal_code', 'city',
            'country', 'phone', 'email'
        ];

        checkoutButton.addEventListener('click', function() {

            clearServerSideErrors()

            $.ajax({
                url: checkoutAddressStoreUrl,
                method: "POST",
                data: {
                    billing : getAddress(billingAddress, addressFields)
                },
                success: function(response) {
                    clearFormFields()
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    displayServerSideErrors(errors)
                }
            })
            .then(function() {
                $.ajax({
                    url: checkoutStoreUrl,
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