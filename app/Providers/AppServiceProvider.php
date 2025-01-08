<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if(config('app.env') === 'production') {
                $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'auth' => function () {
                return [
                    'user' => auth()->check() ? [
                        'id' => auth()->id(),
                        'name' => auth()->user()->name,
                    ] : null,
                ];
            },
        ]);
    }
}
