<?php

namespace App\Providers;

use App\Services\DeviceService;
use Illuminate\Support\ServiceProvider;

class DeviceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DeviceService::class, function ($app) {
            return new DeviceService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
