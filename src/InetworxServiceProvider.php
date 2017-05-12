<?php

namespace Strebl\Inetworx;

use Illuminate\Support\ServiceProvider;

class InetworxServiceProvider extends ServiceProvider
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
        $this->mergeConfigFrom(__DIR__.'/../config/inetworx.php', 'inetworx');

        $this->app->bind(InetworxClient::class, function () use ($config) {
            return new InetworxClient(
                config('inetworx.auth.credentials.auth_header.username'),
                config('inetworx.auth.credentials.auth_header.password'),
                config('inetworx.auth.credentials.api.username'),
                config('inetworx.auth.credentials.api.password')
            );
        });

        $this->app->alias(InetworxClient::class, 'inetworx-client');
    }
}
