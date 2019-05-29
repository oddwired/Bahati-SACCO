<?php

namespace BahatiSACCO\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateConductor
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
        $guard = 'conductor';

        if(Auth::guard($guard)->check()){
            Auth::guard('member')->logout();
            Auth::guard('admin')->logout();
            return $next($request);
        }
        return redirect(url('conductor/login'));
    }
}
