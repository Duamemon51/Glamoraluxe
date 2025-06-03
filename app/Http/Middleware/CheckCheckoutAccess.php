<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCheckoutAccess
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if (auth()->check()) {
            // Example check: cart must have items
            $cart = session('cart'); // ya aap apna cart logic yahan use karo

            if (empty($cart) || count($cart) == 0) {
                // Agar cart empty hai to redirect kar do cart page ya home
                return redirect()->route('cart.index')->with('error', 'Please add items to cart before checkout.');
            }
            
            // Agar sab theek hai, toh request aage badhne do
            return $next($request);
        }

        // Agar guest hai to login page bhej do
        return redirect()->route('login');
    }
}
