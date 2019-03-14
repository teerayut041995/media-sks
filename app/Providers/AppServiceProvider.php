<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        carbon::setLocale('th');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once base_path().'/app/Http/helpers.php';
    }
}
