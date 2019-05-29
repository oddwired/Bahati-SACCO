<?php

namespace BahatiSACCO\Http\Middleware;

use BahatiSACCO\Member;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCompleteInformation
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
        if(!Auth::guard('member')->check()){
            return redirect(url('member/login'));
        }

        $member = Member::find(Auth::guard('member')->id());

        if(is_null($member->phone) || is_null($member->postal_address) || is_null($member->national_id)
            || is_null($member->postal_code) || is_null($member->postal_town)){
            return redirect(url('member/edit-information'))
                ->with(['info'=> "Update your information first"]);
        }

        return $next($request);
    }
}
