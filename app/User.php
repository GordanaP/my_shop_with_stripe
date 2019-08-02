<?php

namespace App;

use App\Traits\User\HasAccount;
use App\Traits\User\HasAddress;
use App\Traits\User\HasProfile;
use App\Traits\User\HasAttributes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasAccount, HasAddress, HasProfile, HasAttributes, Notifiable;

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
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function shippings()
    {
        return $this->hasManyThrough('App\Shipping', 'App\Customer');
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
     * @param  \App\User $user
     * @return boolean
     */
    public function isRequestedUser($user)
    {
        return $this->id == $user->id;
    }
}
