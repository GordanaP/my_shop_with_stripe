<p class="uppercase font-bold mb-0">
    {{ $customer->full_name }}
</p>
<p class="mb-0">{{ $customer->street_address }}</p>
<p class="mb-0">{{ $customer->postal_code }}
    {{ $customer->city }}</p>
<p class="mb-0">
    {{ Country::getName($customer->country) }}
</p>
<p class="mb-0">tel: {{ $customer->phone }}</p>