<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }

    /**
     * Redirección personalizada después del login
     */
    protected function redirectTo($request): string
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return '/admin/dashboard';
            }

            if ($user->role === 'cajero') {
                return '/cajero/dashboard';
            }
        }

        return '/';
    }
}
