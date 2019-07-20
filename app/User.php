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

        $this->customer()->save($customer);
    }

}
