@extends('layouts.app')

@section('title', 'Online Shop')

@section('links')
    <style>
        .hoverable-card:hover{
            transform:scale(1.2);
            transition: .5s;
            z-index: 2;
        }
    </style>
@endsection

@section('content')
    <header>
        <h2>Our Products</h2>
        <hr>
    </header>

    <section id="products">
        @forelse ($products->chunk(4) as $chunk)
            <div class="row">
                @foreach ($chunk as $product)

                    @include('products.partials.html._product')

                @endforeach
            </div>
        @empty
            There are no products at present.
        @endforelse
    </section>
@endsection