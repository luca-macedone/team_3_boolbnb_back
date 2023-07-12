<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway([
                'environment' => 'sandbox',
                'merchantId' => 'gnqpz3fzybqs5dvp',
                'publicKey' => 'yk6x27z2rpgzpwy4',
                'privateKey' => '6ad14b637e69b3e9659c48a2e7ca1b3b',
            ]);
        });
    }
}
