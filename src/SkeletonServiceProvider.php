<?php

namespace Strebl\Inetworx;

use Illuminate\Support\ServiceProvider;

class SkeletonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/inetworx.php' => config_path('inetworx.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'inetworx');
    }
}
