@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    <header>
        <h4>
            <span>Your shopping cart</span>
            <span class="float-right" style="font-size: 14px">
                <a href="{{ route('products.index') }}">Continue shopping</a>
                @if (! ShoppingCart::fromSession()->isEmpty())
                    <a href="{{ route('users.checkouts.index', Auth::user() ?? '') }}"
                    class="btn btn-primary ml-2">
                        Checkout
                    </a>
                @endif
            </span>
        </h4>
        <hr>
    </header>

    <main>
        @if (! ShoppingCart::fromSession()->isEmpty())
            <table class="table bg-white">
                <thead>
                    <th width="25%">Item</th>
                    <th class="text-center" width="20%">Price</th>
                    <th class="text-center" width="15%">Qty</th>
                    <th class="text-right" width="25%">Subtotal</th>
                    <th class="text-right"><i class="fa-fa-cog"></i></th>
                </thead>
                <tbody>
                    @foreach ($cartItems as $productId => $item)
                        @include('carts.partials.tables._row_item')
                    @endforeach
                </tbody>
            </table>
        @else
            The shopping cart is empty.
        @endif
    </main>

@endsection