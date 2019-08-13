<form action="{{ route('carts.store', $product) }}" method="POST">

    @csrf

    <button type="submit" class="inline-block w-full font-semibold bg-indigo-500 hover:bg-indigo-600 rounded shadow text-white text-xs uppercase tracking-wider py-1 mt-2 text-center">
        <i class="fa fa-shopping-cart mr-1"></i> Add to cart
    </button>

</form>