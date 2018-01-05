<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
       /*if (Auth::guard($guard)->check()) {
            return redirect('/welcome');
        }*/
        if(Auth::guard($guard)->guest()){
            if($request->ajax()){
                return response('Unauthorized',404);    
            }else{
                return redirect()->route('home');
            }            
        }

        return $next($request);
    }
}
