<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            $user = $request->user();
            $route = $user->role === 'admin' ? 'admin.dashboard' : ($user->role === 'cajero' ? 'cajero.dashboard' : 'home');
            return redirect()->intended(route($route, absolute: false));
        }

        return view('auth.verify-email');
    }
}
