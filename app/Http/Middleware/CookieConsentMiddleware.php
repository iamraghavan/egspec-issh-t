<?php

// app/Http/Middleware/CookieConsentMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CookieConsentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->cookie('cookie_consent')) {
            // Add a flag to the request so that the frontend can display the cookie notice
            $request->attributes->set('show_cookie_notice', true);
        }

        return $next($request);
    }
}
