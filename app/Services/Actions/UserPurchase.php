<?php

namespace App\Services\Actions;

use App\User;
use App\Interfaces\Purchase;
use App\Services\Actions\PlaceOrder;

class UserPurchase implements Purchase
{
    /**
     * The user.
     *
     * @var \App\User
     */
    public $user;

    /**
     * The payment
     * @var string
     */
    public $payment;

    /**
     * Create a new class instance.
     *
     * @param \App\User $user
     * @param string $payment
     * @return void
     */
    public function __construct(User $user, $payment)
    {
        $this->user = $user;
        $this->payment = $payment;
    }

    /**
     * Handle the registered user's purchase.
     *
     * @return void
     */
    public function handle()
    {
        $customer = $this->getBillingAddress($this->user);

        $shipping = $this->getShippingAddress($customer);

        (new PlaceOrder($customer))->complete($shipping, $this->payment);
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
