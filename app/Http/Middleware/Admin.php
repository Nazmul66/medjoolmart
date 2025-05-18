<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if( !Auth::guard('admin')->check() ){
            // Log::info('Admin not authenticated.');
            return redirect('/admin/login');
        }
        else{
            // Log::info('Admin authenticated.');
            return $next($request);
        }
    }
}
