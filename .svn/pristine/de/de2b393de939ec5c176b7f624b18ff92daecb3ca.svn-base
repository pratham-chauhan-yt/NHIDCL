<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (\Illuminate\Http\Request $request) {
            $email = (string) $request->input('login'); // can be email or user_code
            return Limit::perMinutes(20, 3)->by($email . '|' . $request->ip());
        });

        // Password Reset: 3 attempts per day
        RateLimiter::for('password-email-daily', function (Request $request) {
            return Limit::perDay(3)->by((string) $request->input('email'));
        });

        RateLimiter::for('otp-verify', function (Request $request) {
            $userId = $request->session()->get('otp_user_id') ?? $request->ip();
            return Limit::perMinutes(10, 3)->by($userId);
        });

        RateLimiter::for('password-backend-email-daily', function (Request $request) {
            return Limit::perDay(3)->by((string) $request->input('email'));
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
