<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Services\Contracts\FlowerServiceInterface::class, \App\Services\FlowerService::class);
        $this->app->bind(\App\Services\Contracts\CategoryServiceInterface::class, \App\Services\CategoryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
