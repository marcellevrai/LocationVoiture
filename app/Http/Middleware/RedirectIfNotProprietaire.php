<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotProprietaire
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('proprietaire')->check()) {
            return redirect()->route('proprietaire.login'); 
        }

        return $next($request);
    }
}
