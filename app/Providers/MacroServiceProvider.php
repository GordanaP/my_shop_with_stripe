<?php

namespace App\Providers;

use App\Facades\Calculator;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro('presentInDollars', function ($price_in_cents) {

            $priceInDollars = Calculator::divide($price_in_cents, 100);

            return '$'.$priceInDollars;
        });

        Str::macro('presentAsPercent', function ($float) {

            $product = Calculator::multiply($float, 100);

            return $product.'%';
        });
    }
}
