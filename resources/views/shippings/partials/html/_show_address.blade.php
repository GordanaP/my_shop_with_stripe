<div class="card" style="height: 350px">

    <div class="card-body text-lg">
        <p class="mb-0">
            <span class="uppercase">{{ $customer->full_name }}</span>
            <span class="bg-orange-400 text-sm px-2 py-1 rounded-lg text-white ml-2">
                Default
            </span>
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

        @if (request()->route()->named('users.shippings.index'))
            <span class="mx-2">|</span>
            <form action="#" method="POST">
                @csrf
                @method('PUT')

                <button type="submit" class="btn btn-link p-0">Set as default</button>
            </form>
    </div>
    @endif
</div>