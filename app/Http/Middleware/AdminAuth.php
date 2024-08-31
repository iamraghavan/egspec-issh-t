<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Allow access to login and other non-authenticated routes
        if (Auth::guard('admin')->check() && $request->routeIs('login')) {
            return redirect()->route('admin.dashboard'); // Redirect to dashboard if already logged in
        }

        // Redirect to login if not authenticated
        if (!Auth::guard('admin')->check() && !$request->routeIs('login') && !$request->routeIs('auth.admin-login')) {
            return redirect()->route('login');
        }

        // Continue to the next request if authenticated
        return $next($request);
    }
}
