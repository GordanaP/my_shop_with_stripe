<?php

namespace App\Services\Utilities;

class Presenter
{
    /**
     * Present the price togehter with currency.
     *
     * @param  float $priceInDolars
     * @return string
     */
    public function withCurrency($priceInDolars)
    {
        return config('cart.currency') . $priceInDolars;
    }

    /**
     * Present a value in procents;
     *
     * @param  mixed $value
     * @return string
     */
    public function inProcents($value)
    {
        return $value . '%';
    }
}