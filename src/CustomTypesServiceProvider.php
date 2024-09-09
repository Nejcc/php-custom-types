<?php

declare(strict_types=1);

namespace Nejcc\CustomTypes;

use Illuminate\Support\ServiceProvider;

final class CustomTypesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.                               Services
     * --------------------------------------------------------------------------
     * This method binds custom type classes to the service container 
     * and makes them available throughout the Laravel application.
     */
    public function register(): void
    {
        // Register custom types or bindings here
    }

    /**
     * Bootstrap any package services.                                  Bootstraps
     * --------------------------------------------------------------------------
     * This method is used to bootstrap any package-specific services, 
     * such as publishing configuration files or performing other 
     * necessary startup tasks for the package.
     */
    public function boot(): void
    {
        // Bootstrapping services for the package
    }
}
