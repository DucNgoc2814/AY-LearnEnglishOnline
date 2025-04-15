<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use App\Http\View\Composers\HeaderComposer;

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
    }
}
