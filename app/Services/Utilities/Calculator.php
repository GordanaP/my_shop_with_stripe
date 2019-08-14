<?php

namespace App\Services\Utilities;

class Calculator
{
    /**
     * Get a product of two numbers.
     *
     * @param  mixed $a
     * @param  mixed $b
     * @return mixed
     */
    public function multiply($a, $b)
    {
        return $a * $b;
    }

    /**
     * Get a quotient of two numbers.

     * @param  mixed $a
     * @param  mixed $b
     * @return mixed
     */
    public function divide($a, $b)
    {
        return number_format(($a / $b), 2);
    }

    /**
     * Get a sum of two numbers.

     * @param  mixed $a
     * @param  mixed $b
     * @return mixed
     */
    public function add($a, $b)
    {
        return $a + $b;
    }

    /**
     * Get a difference of two numbers.

     * @param  mixed $a
     * @param  mixed $b
     * @return mixed
     */
    public function subtract($a, $b)
    {
        return $a / $b;
    }
}