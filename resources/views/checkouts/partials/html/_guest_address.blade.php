<div class="flex justify-between mb-2">
    <span class="font-semibold">{{ $title }}</span>

    @if ($address == 'billing')
        <span>
            <input id="toggleShippingAddress" type="checkbox" class="form-check-input"
                onclick="toggleHiddenFieldVisibility('#guestShippingAddress')" />
            <label class="form-check-label font-normal" for="toggleShippingAddress">
                Different shipping address
            </label>
        </span>
    @endif
</div>

<div class="customer-details card card-body">
    @include('checkouts.partials.forms._add_address', [
        'address' => $address
    ])
</div>