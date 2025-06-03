<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Agar user login nahi hai, to home page par redirect kar do
            return redirect('login');
        }

        return $next($request);
    }
}
