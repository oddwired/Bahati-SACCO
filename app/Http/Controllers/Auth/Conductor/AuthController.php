<?php

namespace BahatiSACCO\Http\Controllers\Auth\Conductor;

use BahatiSACCO\Conductor;
use BahatiSACCO\Jobs\MailJob;
use BahatiSACCO\MailModel;
use BahatiSACCO\PasswordReset;
use foo\bar;
use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('conductor.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email'=> ['required', 'string', 'email', 'max:255', 'exists:conductors'],
            'password'=> ['required', 'string', 'max:255']
        ]);

        $data = [
            'email'=> $request->email,
            'password'=> $request->password
        ];

        if(Auth::guard('conductor')->attempt($data)){
            return redirect(url("conductor"));
        }

        return back()->withErrors(["password"=> "Invalid password"]);
    }

    public function register(Request $request){
        $this->validate($request, [
            'first_name'=> ['required', 'string', 'max:255'],
            'last_name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'string', 'email', 'max:255', 'unique:conductors']
        ]);

        $data = [
            "first_name"=> strtoupper($request->first_name),
            "last_name"=> strtoupper($request->last_name),
            "email"=> $request->email,
            "password"=> bcrypt("$request->email".time())
        ];

        if(Conductor::create($data)){
            return back()->with(['info'=> "Conductor added"]);
        }

        return back()->withErrors(["error"=> "An error occurred"]);
    }

    public function forgotPassword(){
        return view("conductor.forgot_password");
    }

    public function sendResetLink(Request $request){
        $this->validate($request, [
            "email"=> ['required', 'email', 'exists:conductors'],
        ]);

        $user = Conductor::where('email', $request->email)->first();
        $role = "conductor";
        $access_hash = md5($user->email.time());

        $data = [
            "email"=> $user->email,
            "role"=> $role,
            "access_hash"=> $access_hash
        ];

        PasswordReset::create($data);

        $name = $user->first_name;
        $email = $user->email;
        $subject = "Password Reset";
        $body = "Follow this link to reset your account password: ". url('password-reset/'.$access_hash);

        $email_send = new MailModel($name, $email, $subject, $body);

        dispatch(new MailJob(serialize($email_send)));

        return view('link_sent', ["message"=> "Password reset link sent. Check you inbox."]);
    }

    public function logout(){
        Auth::guard('conductor')->logout();
        return redirect(url('conductor/login'));
    }
}
