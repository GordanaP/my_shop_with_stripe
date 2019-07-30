<?php

namespace App;

use App\Shipping;
use App\Traits\Customer\HasAttributes;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'street_address', 'postal_code', 'city',
        'country', 'email', 'phone'
    ];

    /**
     * Get the user's attribute.
     *
     * @return boolean
     */
    public function getIsDefaultAttribute()
    {
        return $this->shippings->where('default_address', true)->isEmpty();
    }

    /**
     * Get the user that owns the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the shippings that belong to the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }

    /**
     * Get the customer's data from form.
     *
     * @param  array $data
     * @return \App\Customer
     */
    public static function fromForm(array $data)
    {
        return (new static)->fill($data);
    }

    /**
     * Add the shipping address to the customer.
     *
     * @param array $data
     * @return void
     */
    public function addShipping(array $data)
    {
        $shipping = Shipping::fromForm($data);

        return $this->shippings()->save($shipping);
    }
}
