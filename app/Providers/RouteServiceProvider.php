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

// namespace App\Providers;

// use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Route;

// class RouteServiceProvider extends ServiceProvider
// {
//     /**
//      * Define the routes for the application.
//      *
//      * @return void
//      */
//     public function map()
// {
//     $this->routes(function () {

//         Log::info('RouteServiceProvider Loaded');

//         Route::middleware('api')
//             ->prefix('api') // Ensures the 'api' prefix is applied to your routes
//             ->group(base_path('routes/api.php'));

//         Route::middleware('web')
//             ->group(base_path('routes/web.php'));
//     });
// }

// }
