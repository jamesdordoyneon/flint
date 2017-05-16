<?php

namespace Flint\Providers;

use Illuminate\Support\ServiceProvider;
use Flint\Managers\AssetManager;

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
        $this->app->singleton('flint', function ($app) {
            return new AssetManager();
        });
    }
}
