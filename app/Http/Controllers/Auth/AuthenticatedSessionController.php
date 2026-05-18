<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        $role = strtolower(trim((string)$user->rol->nombre ?? ''));

        if (in_array($role, ['admin', 'administrador'])) {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'cajero') {
            return redirect()->route('cajero.dashboard');
        }

        // Fallback si no coincide, mostrar qué rol tenía para depurar si falla
        return redirect()->route('home')->with('error', 'Rol no reconocido: ' . $role);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

