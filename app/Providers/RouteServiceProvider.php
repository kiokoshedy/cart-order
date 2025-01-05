<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::middleware('api')
             ->prefix('api')
             ->namespace('App\Http\Controllers\Api')
             ->group(base_path('routes/api.php'));
    }
}
