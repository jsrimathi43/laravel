<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OrderStatusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('orderStatus', function () {
            return config('order_statuses');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // You can add any bootstrapping code here
    }
}
