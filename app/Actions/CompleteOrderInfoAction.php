<?php

namespace App\Actions;

use App\Order;
use App\Facades\ShoppingCart;
use App\Actions\CreateOrderCustomerAction;

class CompleteOrderInfoAction
{
    public $user;

    public function __construct($user = null)
    {
        $this->user =  $user;
    }

    public function execute()
    {
        $paymentIntent = '123456';

        $order = Order::fromShoppingCart();

        $customer = $this->getCustomer();

        $order->completeShipping($this->getShippingId($customer));

        $order->completePayment($paymentIntent);

        return $customer->placeOrder($order);
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

    public function getRegisteredShippingId()
    {
        $shippingAddress = collect(request()->address);

        return $shippingAddress->has('customer_id') ? $shippingAddress->get('id') : null;
    }

    public function createRegisteredShippingId($customer)
    {
        $address = collect(request()->address);
        $shipping = $address->get('shipping');
        // $customer = $this->getCustomer();

        return $address->has('shipping')
            ? $customer->shippings()->create($shipping)->id : null;
    }

    public function createGuestShippingId($customer)
    {
        $shippingAddress = ShoppingCart::fromSession()->getOwner('address', 'shipping')->toArray();
        // $customer = $this->getCustomer();

        return $shippingAddress ? $customer->shippings()->create($shippingAddress)->id : null;
    }

    public function getCustomer()
    {
        return (new CreateOrderCustomerAction($this->user))->execute();
    }
}