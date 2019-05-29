<?php

namespace BahatiSACCO\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
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
        $guard = 'admin';

        if(Auth::guard($guard)->check()){
            Auth::guard('member')->logout();
            Auth::guard('conductor')->logout();
            return $next($request);
        }
        return redirect(url('admin/login'));
    }
}
