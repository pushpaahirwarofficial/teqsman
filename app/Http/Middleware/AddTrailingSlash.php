<?php

namespace App\Http\Middleware;

use Closure;

class AddTrailingSlash
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = $request->url();

        // Check if the URL ends with a trailing slash
        if (!str_ends_with($url, '/')) {
            return redirect()->to($url . '/');
        }

        return $next($request);
    }
}
