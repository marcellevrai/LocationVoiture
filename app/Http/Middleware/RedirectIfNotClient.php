<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('client')->check()) {
            return redirect()->route('client.login'); // redirection personnalisée
        }

        return $next($request);
    }
}
