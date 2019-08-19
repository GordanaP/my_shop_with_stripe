<?php

namespace App\Services\Actions;

use App\User;
use App\Services\Actions\CompleteOrder;


class RecordUserPurchase
{
    /**
     * The user.
     *
     * @var \App\User
     */
    public $user;

    /**
     * Create a new class instance.
     *
     * @param \App\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the registered user's purchase.
     *
     * @param  string $paymentIntent
     * @return void
     */
    public function handle($paymentIntent)
    {
        $customer = $this->getBillingAddress($this->user);

        $shipping = $this->getShippingAddress($customer);

        $order = (new CompleteOrder)->handle($shipping, $paymentIntent);

        $customer->placeOrder($order);
    }

    /**
     * Get the billing address;
     *
     * @param  \App\User $user
     * @return \App\Customer
     */
    protected function getBillingAddress($user)
    {
        $customer = $this->address()->get('billing');

        return $user->addCustomer($customer);
    }

    /**
     * Get the shipping address.
     *
     * @param  \App\Customer $customer
     * @return integer
     */
    protected function getShippingAddress($customer)
    {
        $shipping = $this->address()->get('shipping');

        return $this->address()->has('shipping') ? $customer->addShipping($shipping)->id : null;
    }

    /**
     * Get the addresses.
     *
     * @return Illuminate\Support\Collection
     */
    private function address()
    {
        return collect(request('address'));
    }
}
