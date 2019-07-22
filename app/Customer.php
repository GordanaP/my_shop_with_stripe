<?php

namespace App;

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
     * Get the user that owns the customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
}
