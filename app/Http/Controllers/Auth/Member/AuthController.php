<?php

namespace BahatiSACCO\Http\Controllers\Auth\Member;

use BahatiSACCO\Jobs\MailJob;
use BahatiSACCO\MailModel;
use BahatiSACCO\Member;
use BahatiSACCO\PasswordReset;
use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('member.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email'=> ['required', 'string', 'email', 'max:255'],
            'password'=> ['required', 'string', 'max:255']
        ]);

        $data = [
            'email'=> $request->email,
            'password'=> $request->password
        ];

        if(Auth::guard('member')->attempt($data)){
            return redirect(); //Redirect to member dashboard
        }

        return back()->withErrors(["Error"=> "Invalid credentials"]);
    }

    public function register(Request $request){
        $this->validate($request, [
            'first_name'=> ['required', 'string', 'max:255'],
            'last_name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'string', 'email', 'max:255', 'unique:members']
        ]);

        $data = [
            "first_name"=> $request->first_name,
            "last_name"=> $request->last_name,
            "email"=> $request->email,
            "password"=> bcrypt("$request->email".time())
        ];

        if(Member::create($data)){
            return back()->with(['info'=> "Member added"]);
        }

        return back()->withErrors(["error"=> "An error occurred"]);
    }

    public function forgotPassword(){
        return view("member.forgot_password");
    }

    public function sendResetLink(Request $request){
        $this->validate($request, [
            "email"=> ['required', 'email', 'exists:members'],
        ]);

        $user = Member::where('email', $request->email)->first();
        $role = "member";
        $access_hash = md5($user->email.time());

        $data = [
            "email"=> $user->email,
            "role"=> $role,
            "access_hash"=> $access_hash
        ];

        PasswordReset::create($data);

        $name = $user->name;
        $email = $user->email;
        $subject = "Password Reset";
        $body = "Follow the link below to reset your account password: \n ". url('reset-password/'.$access_hash);

        $email_send = new MailModel($name, $email, $subject, $body);

        dispatch(new MailJob(serialize($email_send)));

        return view('link_sent', ["message"=> "Password reset link sent. Check you inbox."]);
    }

    public function logout(){
        Auth::guard('member')->logout();
        return redirect(url('member/login'));
    }
}
