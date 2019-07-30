<?php

namespace App;

use App\Scopes\RegisteredCustomerScope;
use Illuminate\Database\Eloquent\Model;

class RegisteredCustomer extends Customer
{
    protected $table = 'customers';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new RegisteredCustomerScope);
    }

    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }
}
