<?php

namespace App;

use App\Scopes\RegisteredCustomerScope;
use Illuminate\Database\Eloquent\Model;

class RegisteredCustomer extends Customer
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new RegisteredCustomerScope);
    }

    /**
     * Get all of the shipping addresses for the registered customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }
}
