<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        // Cuando el middleware 'guest' intercepte a un usuario ya autenticado,
        // redirigirlo al dashboard correspondiente según su rol.
        RedirectIfAuthenticated::redirectUsing(function ($request) {
            $user = Auth::user();

            if ($user) {
                $role = strtolower(trim((string)$user->rol->nombre ?? ''));
                
                if (in_array($role, ['admin', 'administrador'])) {
                    return route('admin.dashboard');
                }

                if ($role === 'cajero') {
                    return route('cajero.dashboard');
                }
            }

            return route('home');
        });
    }
}
