<form action="{{ route('carts.update', $productId) }}" method="POST">

    @csrf
    @method('PATCH')

    <div class="mx-auto flex">

        <div class="form-group">
            <input type="text" name="quantity" id="quantity"
            class="form-control text-center @error('quantity') is-invalid @enderror"
            value="{{ $item->quantity }}">

            @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn">
                <i class="fa fa-refresh"></i>
            </button>
        </div>
    </div>

</form>