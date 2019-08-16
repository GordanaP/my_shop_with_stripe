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
                        @include('checkouts.partials.html._customer_address', [
                            'title' => 'Billing address',
                            'route' => route('customers.edit', $user->customer),
                            'default_delivery' => '',
                            'customer' => $user->customer,
                        ])
                    </div>

                    <div class="shipping-address mt-8">
                        @include('checkouts.partials.html._customer_address', [
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

        var checkoutButton = document.querySelector('#checkoutButton');

        var usersCheckoutStoreUrl = "{{ route('checkout.users.store', $user)}}";

        var shippingAddress = @json($user->getCheckoutShippingAddress($shipping));

        checkoutButton.addEventListener('click', function() {
            clearServerSideErrors()

            $.ajax({
                url: usersCheckoutStoreUrl,
                method: 'POST',
                data: {
                    shipping_address: shippingAddress
                },
                success: function(result)
                {
                    console.log(result)

                    // redirectTo(result.redirectToUrl)
                }
            });
        });

    </script>
@endsection