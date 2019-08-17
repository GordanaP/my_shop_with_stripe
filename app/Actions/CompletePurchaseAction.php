<?php

namespace App\Actions;

use App\User;
use App\Order;
use App\Facades\ShoppingCart;
use App\Actions\CompleteOrderInfoAction;
use App\Actions\CreateOrderCustomerAction;

class CompletePurchaseAction
{
    public $user;

    public function __construct($user = null)
    {
        $this->user = $user;
    }

    public function execute()
    {
        $paymentIntent = '123456';

        $order = $this->getOrder();

        $order->completePayment($paymentIntent);

        $customer = $this->getOrderCustomer();

        $customer->placeOrder($order);
    }

    public function getOrder()
    {
        return (new CompleteOrderInfoAction($this->user))->execute()['order'];
    }

    public function getOrderCustomer()
    {
        return (new CompleteOrderInfoAction($this->user))->execute()['customer'];
    }

}