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
                        @include('checkouts.partials.html._guest_address', [
                            'title' => 'Billing address',
                            'address' => 'billing'
                        ])
                    </div>

                    <div id="guestShippingAddress" class="shipping-address mt-8 hidden">
                        @include('checkouts.partials.html._guest_address', [
                            'title' => 'Shipping address',
                            'address' => 'shipping'
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

        var hiddenAddress = document.querySelector('#guestShippingAddress');
        var toggleHiddenAddressCheckbox = document.querySelector('#toggleShippingAddress');
        var billing = 'billing';
        var shipping = 'shipping';
        var addressFields = [
            'first_name', 'last_name', 'street_address', 'postal_code', 'city',
            'country', 'phone', 'email'
        ];

    </script>
@endsection