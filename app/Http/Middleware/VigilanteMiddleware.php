<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VigilanteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->status == 1 && Auth::user()->level == 2){
            if(Auth::user()->level==2){
                return $next($request);
            }else{  
                Auth::logout();
                return redirect(url('/'));
            } 
        }else{
            Auth::logout();
            return redirect(url('/'));
        }
    }
}
