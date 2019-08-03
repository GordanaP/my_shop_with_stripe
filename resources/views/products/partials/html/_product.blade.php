<div class="col-sm-6 col-md-3">
    <div class="card card-body">

        <div class="thumbnail">
             <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="{{ $product->name }}">
        </div>

        <div class="caption">
            <h4 class="font-light">{{ $product->name }}</h4>

            <p class="font-medium">
                {{ $product->price_presented_in_dollars }}
            </p>

            <p class="text-xs text-gray-600">{{ $product->description }}</p>

            @include('carts.partials.forms._add_item')
        </div>
    </div>
</div>