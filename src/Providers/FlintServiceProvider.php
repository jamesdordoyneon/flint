<?php

namespace Flint\Providers;

class FlintServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton('fractal', function ($app) {
        //     return new Manager();
        // });
    }
}
