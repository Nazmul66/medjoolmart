<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LandingPageSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the current path starts with "landing-page/"
        if (!str_starts_with($request->path(), 'landing-page')) {
            // If not, destroy the landing product session
            session()->forget('landing_product');
        }

        return $next($request);
    }
}
