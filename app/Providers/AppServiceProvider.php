<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::share('flash', function () {
            return [
                'error'   => Session::get('error'),
                'success' => Session::get('success'),
            ];
        });

        // Lazily
        Inertia::share('user', fn (Request $request) => $request->user()
            ? $request->user()->only('id', 'name', 'email', 'role')
            : null
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
