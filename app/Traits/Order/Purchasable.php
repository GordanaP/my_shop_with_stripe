<?php

namespace App\Traits\Order;

use App\Shipping;

trait Purchasable
{
    /**
     * Get the registered customer's shipping address id.
     *
     * @return integer | null
     */
    protected function getRegisteredShippingId()
    {
        return $this->address()->has('customer_id') ? $this->address()->get('id') : null;
    }

    /**
     * Create registered user's shipping address id.
     *
     * @param  \App\Customer $customer
     * @return integer | null
     */
    protected function createRegisteredShippingId($customer)
    {
        $shipping = $this->address()->get('shipping');

        return $this->address()->has('shipping') ? $customer->addShipping($shipping)->id : null;
    }

    /**
     * Create the guest customer's shipping address id.
     *
     * @param  \App\Customer $customer
     * @return integer | null
     */
    protected function createGuestShippingId($customer)
    {
        $shippingAddress = Shipping::getFromShoppingCart();

        return $shippingAddress ? $customer->addShipping($shippingAddress)->id : null;
    }

    protected function createRegisteredCustomer($user)
    {
        $billingAddress = $this->address()->get('billing');

        return $user->addCustomer($billingAddress);
    }

    private function address()
    {
        return collect(request('address'));
    }
}
