<?php

namespace CaashApp\Plaid;

use Illuminate\Support\ServiceProvider;
use CaashApp\Plaid\Client\Factory;

class PlaidServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('plaid', function ($app) {
            return new Factory(
                config('plaid.client'),
                config('plaid.secret'),
                config('plaid.env'),
                config('app.name'),
            );
        });
    }
}
