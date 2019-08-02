<div class="col-sm-6 col-md-3">
    <div class="card card-body">

        <div class="thumbnail">
             <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="{{ $product->name }}">
        </div><!-- /.thumbnail -->

        <div class="caption">
            <h4 class="font-light">{{ $product->name }}</h4>
            <p class="font-medium">
                {{ Price::present($product->price_in_dollars) }}
            </p>
            <p class="text-xs text-gray-600">{{ $product->description }}</p>

            <form action="#" method="POST">

                @csrf

                <button type="submit" class="btn btn-sm btn-block btn-primary">
                    <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
                </button>

            </form>
        </div>
    </div>
</div>