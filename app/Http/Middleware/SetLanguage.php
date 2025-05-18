<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setLocalLanguage = Session::get('langName');

        if( !isset( $setLocalLanguage ) ){
           App::setlocale('en');
        }
        else{
            App::setlocale($setLocalLanguage);
        }
        
        return $next($request);
    }
}
