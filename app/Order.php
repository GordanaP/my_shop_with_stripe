<?php

namespace App;

use App\Facades\ShoppingCart;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'subtotal_in_cents', 'tax_amount_in_cents', 'shipping_costs_in_cents',
        'total_in_cents', 'paid'
    ];

    /**
     * Get the customer that owns the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the shipping that owns the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }

    public static function fromShoppingCart()
    {
        $shipping = collect(request()->shipping_address);

        $data = ShoppingCart::fromSession()->getSummary()->union([
            'shipping_id' => $shipping->has('customer_id') ? $shipping->get('id') : null
        ])->toArray();

        return (new static)->fill($data);
    }

    public function completePayment($paymentIntent)
    {
        $this->order_number = $paymentIntent;
        $this->stripe_payment_id = $paymentIntent;
        $this->paid = true;

        return $this;
    }
}
