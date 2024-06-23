<?php

namespace Broswilli\LaravelYmlRoutes;

use Illuminate\Support\ServiceProvider;

class LaravelYmlRoutesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        if (app()->environment() == 'testing') {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        }
        

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-yml-routes.php'),
                __DIR__.'/../resources/routes' => resource_path('routes'),
            ], 'laravel-yml-routes-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-yml-routes');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-yml-routes', function () {
            return new LaravelYmlRoutes;
        });
    }
}
