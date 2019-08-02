@extends('layouts.app')

@section('title', 'Online Shop')

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

        @endforelse
    </section>
@endsection