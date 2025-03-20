<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//shaf adding one line
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        //shaf adding one line
        Blade::component('components.splashscreen', 'splashscreen');

    }
}
