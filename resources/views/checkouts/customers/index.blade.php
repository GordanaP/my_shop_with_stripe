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
                        @withProfile($user)
                            @include('checkouts.partials.html._customer_address', [
                                'title' => 'Billing address',
                                'route' => route('customers.edit', $user->customer),
                                'default_delivery' => '',
                                'customer' => $user->customer,
                            ])
                        @else
                            @include('checkouts.partials.html._guest_address', [
                                'title' => 'Billing address',
                                'address' => 'billing'
                            ])
                        @endwithProfile
                    </div>

                    <div class="shipping-address mt-8">
                        @withProfile($user)
                            @include('checkouts.partials.html._customer_address', [
                                'title' => 'Shipping address',
                                'route' => route('users.select.delivery', $user),
                                'customer' => $shipping ?: ($default_delivery ?: $user->customer),
                            ])
                        @else
                            <div class="hidden" id="guestShippingAddress">
                                @include('checkouts.partials.html._guest_address', [
                                    'title' => 'Shipping address',
                                    'address' => 'shipping'
                                ])
                            </div>
                        @endwithProfile
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

        var registeredCustomer = @json($user->hasProfile());
        var registeredShippingAddress = @json($user->getCheckoutShippingAddress($shipping));

        var checkoutButton = document.querySelector('#checkoutButton');
        var checkoutStoreUrl = "{{ route('checkout.store', $user) }}";

        var hiddenAddress = document.querySelector('#guestShippingAddress');
        var toggleHiddenAddressCheckbox = document.querySelector('#toggleShippingAddress');
        var billing = 'billing';
        var shipping = 'shipping';
        var addressFields = [
            'first_name', 'last_name', 'street_address', 'postal_code', 'city',
            'country', 'phone', 'email'
        ];

        checkoutButton.addEventListener('click', function() {

            $.ajax({
                url: checkoutStoreUrl,
                type: "POST",
                data: {
                    address: registeredCustomer ? registeredShippingAddress : getCheckedAddress(toggleHiddenAddressCheckbox, billing, shipping, addressFields),
                    payment_method_id: 'dummy234'
                },
                success: function(response)
                {
                    console.log(response);
                }
            });
        });

    </script>
@endsection