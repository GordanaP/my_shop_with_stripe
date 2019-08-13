<div class="col-sm-6 col-md-3">
    <a href="$">
        <div class="card hoverable-card shadow">
            <img class="card-img-top" src="{{ asset('images/test.jpg') }}">

            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>

                <p>{{ $product->price_presented_in_dollars }}</p>

                <p class="card-text text-gray-600">{{ $product->description }}</p>

                <div class="mt-4">
                    @include('carts.partials.forms._add_item')
                </div>
            </div>
        </div>
    </a>
</div>