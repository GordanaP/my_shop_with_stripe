<?php

namespace App\Providers;

use App\Services\Utilities\Country;
use App\Services\Utilities\Calculator;
use Illuminate\Support\ServiceProvider;
use App\Services\Utilities\ShoppingCart;

class UtilityServiceProvider extends ServiceProvider
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
        /**
         * Register a binding of a class with a related container.
         */
        $this->app->bind('country-list', function() {
            return new Country();
        });

        $this->app->bind('shopping-cart', function() {
            return new ShoppingCart();
        });

        $this->app->bind('calculator', function() {
            return new Calculator();
        });
    }
}
