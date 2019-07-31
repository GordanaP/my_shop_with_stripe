<div class="card" style="height: 350px">
    <div class="card-body text-lg">
        <p>
            @if ($user->isBillingAddress($address))
                <span class="bg-indigo-600 text-sm px-3 py-1 rounded-lg text-white mr-2">
                    Billing
                </span>
            @endif

            @if ($address->is_default)
                <span class="bg-orange-400 text-sm px-3 py-1 rounded-lg text-white">
                    Default
                </span>
            @endif
        </p>

        @include('customers.partials.html._show_details', [
            'customer' => $address
        ])
    </div>

    <div class="flex items-center p-3">
        @if ($user->isNotBillingAddress($address))
            <a href="{{ route('shippings.edit', $address) }}">Edit</a>

            <span class="mx-2">|</span>

            @include('shippings.partials.forms._delete')
        @endif

        @if (! $address->is_default && $user->isNotBillingAddress($address))
            <span class="mx-2">|</span>
        @endif

        @if (! $address->is_default)
            @include('shippings.partials.forms._set_as_default')
        @endif
    </div>
</div>