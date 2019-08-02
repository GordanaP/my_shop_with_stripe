<p>
    <span class="font-bold">Billing Address</span>

    @withProfile($user)
        <a href="{{ route('customers.edit', $user->customer) }}" class="ml-1">
            Change
        </a>
    @else
        <span class="pull-right">
            <input id="toggleShippingAddress" type="checkbox" class="form-check-input"
                onclick="toggleHiddenFieldVisibility('#shippingAddress')" />
            <label class="form-check-label font-normal" for="toggleShippingAddress">
                Different shipping address
            </label>
        </span>
    @endwithProfile
</p>

<div class="customer-details card card-body">
    @withProfile($user)
        <p class="uppercase mb-1">{{ optional(optional($user)->customer)->full_name }}</p>

        @include('customers.partials.html._show_details', [
            'customer' => $user->customer
        ])
    @else
        @include('checkouts.partials.forms._add_address', [
            'address' => 'billing'
        ])
    @endwithProfile
</div>
