<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if ($this->isAuthenticated($guard)) {
            return $this->handleAuthenticatedUser($guard);
        }

        return $next($request);
    }

    /**
     * Check if the user is authenticated.
     *
     * @param  string|null  $guard
     * @return bool
     */
    private function isAuthenticated($guard)
    {
        return Auth::guard($guard)->check();
    }

    /**
     * Handle actions for authenticated users.
     *
     * @param  string|null  $guard
     * @return \Illuminate\Http\RedirectResponse
     */
    private function handleAuthenticatedUser($guard)
    {
        $user = Auth::guard($guard)->user();

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        } else {
            Auth::guard($guard)->logout();
            return redirect()->route('login')->withErrors([
                'restricted_area' => 'Access denied. Only Event Organization can access this area.',
            ]);
        }
    }
}
