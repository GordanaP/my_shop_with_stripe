<?php

namespace App\Services\Utilities;

use App\Facades\Presenter;
use App\Facades\Calculator;

class Converter
{
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
     * Convert the price to dollars.
     *
     * @param  integer $priceInCents
     * @return float
     */
    public function toDollars($priceInCents)
    {
        $toDollars = Calculator::divide($priceInCents, 100);

        return Presenter::withCurrency(number_format($toDollars, 2));
    }
}