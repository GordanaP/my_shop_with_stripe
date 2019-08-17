<?php

namespace App\Actions;

use App\Traits\Order\Purchasable;

class CreateOrderCustomerAction
{
    use Purchasable;

    public $user;

    public function __construct($user = null)
    {
        $this->user = $user;
    }

    public function execute()
    {
        if($this->user && $this->user->hasProfile()) {
            return $this->getRegisteredCustomer();
        }

        if($this->user && ! $this->user->hasProfile()) {
            return $this->createRegisteredCustomer();
        }

        if(! $this->user) {
            return $this->createGuestCustomer();
        }
    }
}
