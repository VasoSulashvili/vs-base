<?php

namespace VS\Base;


use Illuminate\Support\ServiceProvider;

class VSBaseServiceProvider extends ServiceProvider
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
        // Register the package's routes
//        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}
