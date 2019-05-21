<?php

namespace BahatiSACCO\Http\Controllers\Auth\Member;

use BahatiSACCO\Member;
use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view(); //TODO return member login view
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
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'string', 'email', 'max:255', 'unique:members']
        ]);

        $data = [
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> bcrypt("$request->email".time())
        ];

        if(Member::create($data)){
            return back()->with(['info'=> "Member added"]);
        }

        return back()->withErrors(["error"=> "An error occurred"]);
    }

    public function logout(){
        Auth::guard('member')->logout();
        return redirect(url('member/login'));
    }
}
