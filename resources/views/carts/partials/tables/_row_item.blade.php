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
        Update qty
    </td>

    <td class="text-right">
        {{ Converter::toDollars($item->subtotal_in_cents) }}
    </td>

    <td class="text-right">
        Remove
    </td>
</tr>