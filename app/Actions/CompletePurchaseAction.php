<?php

namespace App\Actions;

use App\Order;
use App\Facades\ShoppingCart;
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

    // public function getRegisteredShippingId()
    // {
    //     $shippingAddress = collect(request()->address);

    //     return $shippingAddress->has('customer_id') ? $shippingAddress->get('id') : null;
    // }

    // public function createRegisteredShippingId($customer)
    // {
    //     $address = collect(request()->address);
    //     $shipping = $address->get('shipping');

    //     return $address->has('shipping')
    //         ? $customer->shippings()->create($shipping)->id : null;
    // }

    // public function createGuestShippingId($customer)
    // {
    //     $shippingAddress = ShoppingCart::fromSession()->getOwner('address', 'shipping')->toArray();

    //     return $shippingAddress ? $customer->shippings()->create($shippingAddress)->id : null;
    // }

    public function getCustomer($user)
    {
        return (new CreateOrderCustomerAction($user))->execute();
    }
}