<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;

class LoginResponse
{
    public function toResponse($request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        if ($user->role === 'cajero') {
            return redirect()->intended('/cajero/dashboard');
        }

        return redirect()->intended('/');
    }
}
