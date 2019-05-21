<?php

namespace BahatiSACCO\Http\Controllers\Auth\Conductor;

use BahatiSACCO\Conductor;
use foo\bar;
use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view(); //TODO return conductor login view
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

        if(Auth::guard('conductor')->attempt($data)){
            return redirect(); //Redirect to conductor dashboard
        }

        return back()->withErrors(["Error"=> "Invalid credentials"]);
    }

    public function register(Request $request){
        $this->validate($request, [
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'string', 'email', 'max:255', 'unique:conductors']
        ]);

        $data = [
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=> bcrypt("$request->email".time())
        ];

        if(Conductor::create($data)){
            return back()->with(['info'=> "Conductor added"]);
        }

        return back()->withErrors(["error"=> "An error occurred"]);
    }

    public function logout(){
        Auth::guard('conductor')->logout();
        return redirect(url('conductor/login'));
    }
}
