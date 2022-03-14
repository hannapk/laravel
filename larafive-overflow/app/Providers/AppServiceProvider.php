<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laracasts\Flash\FlashServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(FlashServiceProvider::class);
        $this->app->alias('Flash', 'Laracasts\Flash\Flash::class');
    }
}
