<?php

namespace Honviettour\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('api', function() {
            return new \Honviettour\Utilities\Api;
        });
    }
}
