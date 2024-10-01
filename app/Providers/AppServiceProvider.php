<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Auth;
use App\Http\Middleware\DashboardAccess;
class AppServiceProvider extends ServiceProvider
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
        // ... kode lain yang mungkin sudah ada ...

        Route::aliasMiddleware('auth', Auth::class);
        Route::aliasMiddleware('dashboard.access', DashboardAccess::class);

        // ... kode lain yang mungkin sudah ada ...
    }
}
