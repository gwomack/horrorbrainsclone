<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    // public const HOME = '/dashboard';

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        RedirectIfAuthenticated::redirectUsing(function ($request) {
            return route('filament.admin');
        });
    }
}
