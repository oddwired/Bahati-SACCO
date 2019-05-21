<?php

namespace BahatiSACCO\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateMember
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
        $guard = 'member';

        if(Auth::guard($guard)->check()){
            return $next($request);
        }
        return redirect(url('member/login'));
    }
}
