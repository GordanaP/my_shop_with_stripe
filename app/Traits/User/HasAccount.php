<?php

namespace App\Traits\User;

use App\Services\Validated;
use Illuminate\Support\Facades\Session;

trait HasAccount
{
    /**
     * Update the user's account.
     *
     * @param  array $data
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
}