<?php

namespace App\Policies;

use App\User;
use App\Shipping;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShippingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any shippings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the shipping.
     *
     * @param  \App\User  $user
     * @param  \App\Shipping  $shipping
     * @return mixed
     */
    public function view(User $user, Shipping $shipping)
    {
        //
    }

    /**
     * Determine whether the user can create shippings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasProfile();
    }

    /**
     * Determine whether the user can update the shipping.
     *
     * @param  \App\User  $user
     * @param  \App\Shipping  $shipping
     * @return mixed
     */
    public function update(User $user, Shipping $shipping)
    {
        return $user->customer->owns($shipping);
    }

    /**
     * Determine whether the user can delete the shipping.
     *
     * @param  \App\User  $user
     * @param  \App\Shipping  $shipping
     * @return mixed
     */
    public function delete(User $user, Shipping $shipping)
    {
        return $user->customer->owns($shipping);
    }

    /**
     * Determine whether the user can restore the shipping.
     *
     * @param  \App\User  $user
     * @param  \App\Shipping  $shipping
     * @return mixed
     */
    public function restore(User $user, Shipping $shipping)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the shipping.
     *
     * @param  \App\User  $user
     * @param  \App\Shipping  $shipping
     * @return mixed
     */
    public function forceDelete(User $user, Shipping $shipping)
    {
        //
    }
}
