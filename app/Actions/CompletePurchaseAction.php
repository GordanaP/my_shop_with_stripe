<?php

namespace App\Actions;

use App\Order;
use App\Traits\Order\Purchasable;
use App\Actions\CreateOrderCustomerAction;

class CompletePurchaseAction
{
    use Purchasable;

    public $user;

    public function __construct($user = null)
    {
        $this->user =  $user;
    }

    public function execute($paymentIntent)
    {
        $customer = $this->getCustomer($this->user);

        $order = $this->getOrder($customer, $paymentIntent);

        return $customer->placeOrder($order);
    }

    public function getOrder($customer, $paymentIntent)
    {
        return Order::fromShoppingCart()
            ->completeShipping($this->getShippingId($customer))
            ->completePayment($paymentIntent);
    }

    public function getShippingId($customer)
    {
        if($this->user && $this->user->hasProfile())
        {
            return $this->getRegisteredShippingId();
        }

        if($this->user && ! $this->user->hasProfile())
        {
            return $this->createRegisteredShippingId($customer);
        }

        if(! $this->user)
        {
            return $this->createGuestShippingId($customer);
        }
    }

    public function getCustomer($user)
    {
        return (new CreateOrderCustomerAction($user))->execute();
    }
}