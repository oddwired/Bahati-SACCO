<?php

namespace BahatiSACCO\Http\Controllers\Auth;

use BahatiSACCO\Conductor;
use BahatiSACCO\Http\Controllers\Controller;
use BahatiSACCO\Member;
use BahatiSACCO\PasswordReset;
use Illuminate\Http\Request;
class ResetPasswordController extends Controller
{
    public function index(Request $request){

    }

    public function reset(Request $request){
        $this->validate($request, [
            'password'=> ['required', 'string', 'min:8', 'confirmed']
        ]);

        $passwordReset = PasswordReset::where("access_hash", $request->reset_code)->first();

        if(is_null($passwordReset)){
            // TODO: return error
            return back();
        }

        $user = null;
        switch ($passwordReset->role){
            case "member":
                $user = Member::where('email', $passwordReset->email)->first();

                break;
            case "conductor":
                $user = Conductor::where('email', $passwordReset->email)->first();
                break;

            default:

        }

        if(is_null($user)){
            return back(); //TODO: Return error
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect(); // TODO: redirect user to their logins
    }
}
