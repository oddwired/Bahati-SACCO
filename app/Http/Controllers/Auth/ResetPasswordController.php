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
        $passwordReset = PasswordReset::where("access_hash", $request->reset_code)->first();

        if(is_null($passwordReset)){
            abort(404);
        }

        return view('password_reset');
    }

    public function reset(Request $request){
        $this->validate($request, [
            'password'=> ['required', 'string', 'min:8', 'confirmed']
        ]);

        $passwordReset = PasswordReset::where("access_hash", $request->reset_code)->first();

        if(is_null($passwordReset)){
            abort(404);
        }

        $user = null;
        $redirect = null;
        switch ($passwordReset->role){
            case "member":
                $user = Member::where('email', $passwordReset->email)->first();
                $redirect = "member/login";
                break;
            case "conductor":
                $user = Conductor::where('email', $passwordReset->email)->first();
                $redirect = "conductor/login";
                break;

            default:
                $redirect = "/";
        }

        if(is_null($user)){
            return back(); //TODO: Return error
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect(url($redirect))->with(['info'=> "Password reset successful. You can now login"]);
    }
}
