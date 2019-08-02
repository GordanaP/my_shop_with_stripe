<?php

namespace App\Services\Utilities;

class Price
{
    /**
     * Format number to float.
     *
     * @param  integer  $price
     * @param  integer $decimals
     * @return float
     */
    public function getFormatted($price, $decimals = 2)
    {
        return number_format($price, $decimals);
    }

    /**
     * Convert the price to cents.
     *
     * @param  float $priceInDollars
     * @return integer
     */
    public function toCents($priceInDollars)
    {
        return $priceInDollars * 100;
    }

    /**
     * Convert the price o dollars.
     *
     * @param  integer $priceInCents
     * @return float
     */
    public function toDollars($priceInCents)
    {
        return static::getFormatted($priceInCents/100);
    }

    /**
     * Present the price togehter with currency.
     *
     * @param  float $priceInDolars
     * @return string
     */
    public function present($priceInDolars)
    {
        return config('cart.currency') . $priceInDolars;
    }
}