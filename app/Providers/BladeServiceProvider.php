<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
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
        Blade::component('components.validation_info', 'info');
        Blade::component('components.settings_option', 'settings');

        Blade::if('registered', function () {
            return Auth::check() && Auth::user()->hasProfile();
        });
        Blade::if('markAsDefault', function ($shipping, $customer) {
            return $shipping->is_default or ( ! Auth::user()->getDefaultShipping() && $customer == Auth::user()->customer);
        });
    }
}
