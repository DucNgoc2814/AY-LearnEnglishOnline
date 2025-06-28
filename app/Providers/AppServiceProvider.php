<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use App\Http\View\Composers\HeaderComposer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Extend session lifetime
        Config::set('session.lifetime', 120); // 2 hours
        Config::set('session.expire_on_close', false);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        View::composer(['client.layouts.partials.menu-response', 'client.layouts.partials.footer'], HeaderComposer::class);

        // Force HTTPS in production
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Share JWT authenticated user with all views
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (session('jwt_token')) {
                try {
                    $user = \Tymon\JWTAuth\Facades\JWTAuth::setToken(session('jwt_token'))->authenticate();
                    $view->with('auth_user', $user);
                } catch (\Exception $e) {
                    // Clear invalid token
                    session()->forget('jwt_token');
                    $view->with('auth_user', null);
                }
            } else {
                $view->with('auth_user', null);
            }
        });

        // Set default string length for MySQL older versions
        Schema::defaultStringLength(191);

        // Set timezone for MySQL
        DB::statement('SET time_zone = "+07:00"');

        // Set timezone for Carbon
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        Carbon::setLocale('vi');
    }
}
