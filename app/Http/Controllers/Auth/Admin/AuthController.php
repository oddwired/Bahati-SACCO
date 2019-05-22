<?php

namespace BahatiSACCO\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'username'=> ['required', 'exists:admins'],
            'password'=> 'required'
        ]);

        $data = [
            "username"=> $request->username,
            "password"=> $request->password
        ];

        if(Auth::guard('admin')->attempt($data)){
            return redirect(url('admin'));
        }

        return back()->withErrors(["password"=> "Invalid password"]);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(url('admin/login'));
    }
}
