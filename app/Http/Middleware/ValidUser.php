<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
                 if (!Auth::check()) {
            return redirect()->route('login')
                    ->with('error', 'Please login first.');
        }

        // Logged in but not an employee
        if (Auth::user()->role != 'employee') {
            return redirect()->route('login')
                    ->with('error', 'Access denied.');
        }


        return $next($request);
    }
}
