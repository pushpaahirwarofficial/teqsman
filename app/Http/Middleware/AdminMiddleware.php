<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if admin session exists
        if ($request->session()->has('admin')) {
            return $next($request);
        }

        // Redirect to the login route if admin session does not exist
        return redirect()->route('admin_panel.login');
    }
}
