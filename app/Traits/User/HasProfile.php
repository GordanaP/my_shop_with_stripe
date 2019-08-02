<?php

namespace App\Traits\User;

use App\Customer;

trait HasProfile
{
    /**
     * Add the profile.
     *
     * @param array $data
     * @return \App\Customer
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
}