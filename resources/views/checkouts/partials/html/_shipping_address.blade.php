<p class="font-medium">
    Shipping Address
    @withProfile($user)
        <a href="{{ route('users.select.delivery', $user) }}" class="ml-1">
            Change
        </a>
    @endwithProfile
</p>

<div class="customer-details card card-body">
    @withProfile($user)
        <p class="uppercase mb-1">

            {{ $selected_delivery->full_name }}

            @if (optional($selected_delivery)->is_default)
                <span class="bg-orange-400 text-xs px-2 py-1 rounded-lg text-white">
                    Default
                </span>
            @endif
        </p>
        @include('customers.partials.html._show_details', [
            'customer' => $user->getDefaultAddress()
        ])
    @else
        @include('checkouts.partials.forms._add_address', [
            'address' => 'shipping'
        ])
    @endwithProfile
</div>
