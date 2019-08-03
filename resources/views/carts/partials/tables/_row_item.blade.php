<tr>
    <td>
        <p class="text-uppercase mb-2">
            <a href="#">
                {{ $item->name }}
            </a>
        </p>
        <p class="text-xs">{{ $item->description }}</p>
    </td>

    <td class="text-center">
        {{ $item->price_presented_in_dollars }}
    </td>

    <td class="text-center">
        @include('carts.partials.forms._update_quantity')
    </td>

    <td class="text-right">
        {{ Converter::toDollars($item->subtotal_in_cents) }}
    </td>

    <td class="text-right">
        @include('carts.partials.forms._remove_item')
    </td>
</tr>