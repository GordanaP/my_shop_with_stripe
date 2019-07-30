<p class="mb-0">{{ $customer->street_address }}</p>

<p class="mb-0">{{ $customer->zip_and_city }}</p>

<p class="mb-0">{{ Country::getName($customer->country) }}</p>

<p class="mb-0">tel: {{ $customer->phone }}</p>