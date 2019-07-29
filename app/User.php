<?php

namespace App;

use App\Customer;
use App\Services\Validated;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $with = ['customer.shippings'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
     * Get the customer associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * Get all of the shipping addresses for the user.
     */
    public function shippings()
    {
        return $this->hasManyThrough('App\Shipping', 'App\Customer');
    }

    /**
     * Set the user's email.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Update the user's account.
     *
     * @param  array $data]
     * @return void
     */
    public function updateAccount(array $data)
    {
        $validated_data = Validated::getUser($data);

        $this->update($validated_data);
    }

    /**
     * Delete the user's account.
     *
     * @return void
     */
    public function deleteAccount()
    {
        $this->delete();

        Session::flush();
    }

    /**
     * Add the customer's profile.
     *
     * @param array $data
     * @return void
     */
    public function addCustomer(array $data)
    {
        $customer = Customer::fromForm($data);

        return $this->customer()->save($customer);
    }

    /**
     * Determine if the user has profile.
     *
     * @return boolean
     */
    public function hasProfile()
    {
        return $this->customer;
    }

    /**
     * Determine if the user owns the model.
     *
     * @param  \App\Model $model
     * @return boolean
     */
    public function owns($model)
    {
        return $this->id == $model->user_id;
    }

    /**
     * Determine if the authenticate user is the requested user.
     *
     * @param  \App|User  $user
     * @return boolean
     */
    public function isRequestedUser($user)
    {
        return $this->id == $user->id;
    }

    /**
     * Get the user's default shipping address.
     *
     * @return \App\Shipping
     */
    public function getDefaultShipping()
    {
        return $this->shippings->where('default_address', true )->first();
    }

    /**
     * Get a default shipping address.
     *
     * @return mixed
     */
    public function defaultShipping()
    {
        return $this->getDefaultShipping() ?: $this->customer;
    }

    public function getAddressBook()
    {
        $shippings = $this->shippings;

        return $shippings->prepend($this->customer);
    }

    /**
     * Get non default shipping addresses.
     *
     * @return Illuminate\Support\Collection
     */
    public function getNonDefaultShippings()
    {
        $nonDefaultShippings = $this->shippings->where('default_address', false);

        return $this->getDefaultShipping()
            ? $nonDefaultShippings->prepend($this->customer)
            : $nonDefaultShippings;
    }
}
