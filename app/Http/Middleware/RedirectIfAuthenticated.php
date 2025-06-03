<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Agar user admin hai
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Agar user normal user hai, kisi aur dashboard ya home par redirect karna ho to yahan likhein
            return redirect()->route('home'); // ya '/' ya koi aur route
        }

        return $next($request);
    }
}
