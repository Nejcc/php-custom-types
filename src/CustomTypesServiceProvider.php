<?php

namespace Nejcc\CustomTypes;

use Illuminate\Support\ServiceProvider;

class CustomTypesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Here, you could bind any classes or interfaces to the Laravel service container if needed.
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        // Any package bootstrapping logic, such as publishing configuration files, can be placed here.
    }
}