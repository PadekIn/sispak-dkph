<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsPengguna;

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
        Route::aliasMiddleware('isAdmin', IsAdmin::class);
        Route::aliasMiddleware('isPengguna', IsPengguna::class);
    }
}
