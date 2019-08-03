<?php

namespace App\Services\Utilities;

use App\Facades\Converter;
use App\Facades\Presenter;
use App\Facades\Calculator;
use Illuminate\Support\Collection;
use App\Services\Utilities\CartItem;

class ShoppingCart extends Collection
{
    /**
     * Get a shopping cart stored in a session.
     *
     * @return Illuminate\Support\Collection
     */
    public static function fromSession()
    {
        return session('cart', new self);
    }

    /**
     * Add a product with a quantity to the cart.
     *
     * @param \App\Product  $product
     * @param integer $quantity
     * @return void
     */
    public function add($product, $quantity = 1)
    {
        $totalQuantity = $this->getTotalQuantity($product, $quantity);

        $this->put($product->id, CartItem::fromProductAndQuantity($product, $totalQuantity));

        $this->save();
    }

    /**
     * Update a cart item's quantity.
     *
     * @param  \App\Product $product
     * @param  integer $quantity
     * @return void
     */
    public function update($product, $quantity)
    {
        $this->put($product->id, CartItem::fromProductAndQuantity($product, $quantity));

        $this->save();
    }

    /**
     * Remove an item from the cart.
     *
     * @param  integer $productId
     * @return void
     */
    public function remove($productId)
    {
        $this->forget($productId);

        $this->save();
    }

    /**
     * Remove all products from the cart.
     *
     * @return void
     */
    public function destroy()
    {
        session()->forget('cart');
    }

    /**
     * Add a customer's address to the cart.
     *
     * @param  \Illuminate\Support\Collection $address
     * @return void
     */
    public function complete($address)
    {
        $this->put('address', $address);

        $this->save();
    }

    /**
     * Get the cart's owner.
     *
     * @param  string $address
     * @param  string $type
     * @return array
     */
    public function getOwner($address, $type)
    {
        return $this->get($address)->get($type);
    }

    /**
     * Present the cart's total in dollars and the currency.
     *
     * @return string
     */
    public function presentTotal()
    {
        return Converter::toDollars($this->getTotalInCents());
    }

    /**
     * Present the cart's shipping costs in dollars and the currency.
     *
     * @return string
     */
    public function presentShippingCosts()
    {
        return Converter::toDollars($this->getShippingCostsInCents());
    }

    /**
     * Present the cart's tax amount in dollars and the currency.
     *
     * @return string
     */
    public function presentTaxAmount()
    {
        return Converter::toDollars($this->getTaxAmountInCents());
    }

    public function presentTaxRate()
    {
        $taxRate = Calculator::multiply(config('cart.tax'), 100);

        return Presenter::asPercent($taxRate);
    }

    /**
     * Present the cart's subtotal in dollars and the currency.
     *
     * @return string
     */
    public function presentSubtotal()
    {
        return Converter::toDollars($this->getSubtotalInCents());
    }

    // public function getTotalInDollars()
    // {
    //     return Converter::toDollars($this->getTotalInCents());
    // }

    /**
     * Determine if there is any item in the cart.
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->sum('quantity') == 0;
    }

    /**
     * Get the order summary
     *
     * @return illuminate\Support\Collection
     */
    public function getOrderSummary()
    {
        return collect([
            'subtotal' => $this->getSubtotalInCents(),
            'tax_amount' => $this->getTaxAmountInCents(),
            'total' => $this->getTotalInCents(),
        ]);
    }

    /**
     * Calculate the cart's total in cents.
     *
     * @return integer
     */
    public function getTotalInCents()
    {
        return collect([
            $this->getSubtotalInCents(),
            $this->getTaxAmountInCents(),
            $this->getShippingCostsInCents(),
        ])->sum();
    }

    /**
     * Calculate the cart's shipping costs in cents.
     *
     * @return integer
     */
    public function getShippingCostsInCents()
    {
        $shippingCosts = Calculator::multiply($this->getSubtotalInCents(), 0.1);

        return round($shippingCosts);
    }

    /**
     * Calculate the cart's tax amount in cents.
     *
     * @return integer
     */
    public function getTaxAmountInCents()
    {
        $taxAmount = Calculator::multiply($this->getSubtotalInCents(), config('cart.tax'));

        return round($taxAmount);
        // return round($this->getSubtotalInCents() * config('cart.tax'));
    }

    /**
     * Calculate the cart's subtotal in cents.
     *
     * @return integer
     */
    public function getSubtotalInCents()
    {
        return $this->sum('subtotal_in_cents');
    }

    /**
     * Update the cart's content;
     *
     * @return \Illuminate\Support\Collection
     */
    private function save()
    {
        return session()->put('cart', $this);
    }

    /**
     * Calculate the cart item's total quantity.
     *
     * @param  \App\Product $product
     * @param  integer $quantity
     * @return integer
     */
    private function getTotalQuantity($product, $quantity)
    {
        return $quantity + $this->getInCartQuantity($product);
    }

    /**
     * Get the cart item's quantity already in cart.
     *
     * @param  \App\Product $product
     * @return integer
     */
    private function getInCartQuantity($product)
    {
        return optional($this->get($product->id))->quantity ?? 0;
    }
}