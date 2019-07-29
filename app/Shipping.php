<?php

namespace App;

use App\Traits\Customer\HasAttributes;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'street_address', 'postal_code', 'city',
        'country', 'phone'
    ];

    /**
     * Get the customer that owns the shipping.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the shipping from a form.
     *
     * @param  array $data
     * @return \App\Shipping
     */
    public static function fromForm(array $data)
    {
        return (new static)->fill($data);
    }
}
