<div class="card" style="height: 350px">

    <div class="card-body text-lg">
        <p class="mb-0">
            <span class="uppercase">{{ $customer->full_name }}</span>

            @markAsDefault($shipping, $customer)
                <span class="bg-orange-400 text-sm px-2 py-1 rounded-lg text-white ml-2" style="background: orange">
                    Default
                </span>
            @endmarkAsDefault()
        </p>

        @include('customers.partials.html._show_details', [
            'customer' => $customer
        ])
    </div>

    <div class="flex items-center p-3">
        <a href="{{ $customer != Auth::user()->customer ? $edit_shipping : $edit_customer }}">
            Edit
        </a>

        <span class="mx-2">|</span>

        @include('customers.partials.forms._delete')

        @if ( (Auth::user()->customer->is_default && Auth::user()->customer !== $customer) or ! $shipping->is_default)
            <span class="mx-2">|</span>
            <form action="#" method="POST">

                @csrf

                @method('PUT')

                <button type="submit" class="btn btn-link p-0">Set as default</button>
            </form>
        @endif
    </div>
</div>