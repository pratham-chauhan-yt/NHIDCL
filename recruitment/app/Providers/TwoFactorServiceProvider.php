<?php

namespace App\Providers;

use App\Http\Middleware\Verify2FAMiddleware;
use Illuminate\Support\ServiceProvider;

class TwoFactorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    // public function register(): void
    // {
    //     //
    // }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // $this->app->booted(function () {
        //     $router = $this->app['router'];

        //     // $router->appendToGroup('twofactor', [
        //     //     Verify2FAMiddleware::class,
        //     // ]);
        //     $router->group(['middleware' => ['twofactor']], function () use ($router) {
        //         $router->get('/secure-area', function () {
        //             return '2FA protected route';
        //         });
        //     });
        // });
    }
}
