<?php

namespace App\Providers;

use App\Models\User;
use Filament\Support\Facades\FilamentView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        parent::register();
        FilamentView::registerRenderHook('panels::body.end', fn (): string => Blade::render("@vite('resources/js/app.js')"));

        // if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        // }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Gate::define('viewApiDocs', function (User $user) {
            return true;
        });

        // Gate::policy()

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('discord', \SocialiteProviders\Google\Provider::class);
        });

        // Get the current route name
        URL::macro('livewire_current', function () {
            $routeArr = [];
            if (request()->route()->named('livewire.update')) {
                $previousUrl = $this->previous();
                $previousRoute = app('router')->getRoutes()->match(request()->create($previousUrl));

                $routeArr = [
                    'name' => $previousRoute->getName(),
                    'parameters' => $previousRoute->parameters(),
                ];
            } else {
                $routeArr = [
                    'name' => request()->route()->getName(),
                    'parameters' => request()->route()->parameters(),
                ];
            }

            return $routeArr;
        });
    }
}
