<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\RoleOrMiddleware;

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
    public function boot(Router $router): void
    {
        // For registering middlewares
        $router->aliasMiddleware('role', RoleMiddleware::class);
        $router->aliasMiddleware('role_or', RoleOrMiddleware::class);

        // For registering blade directives 

        // Single role directive
        Blade::if('role', function ($role) {
            return Auth::check() && Auth::user()->hasRole($role);
        });

        // // Multiple roles directive
        Blade::if('roleor', function (...$roles) {
            return Auth::check() && Auth::user()->hasAnyRole($roles);
        }); 
    }
}
