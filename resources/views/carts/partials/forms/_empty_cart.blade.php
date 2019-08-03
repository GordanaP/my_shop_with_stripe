<form action="{{ route('carts.empty') }}" method="POST">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash"></i> Empty cart
    </button>

</form>