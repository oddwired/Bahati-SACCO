<?php

namespace BahatiSACCO\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view(); // TODO: create ADMIN view
    }

    public function login(Request $request){
        $this->validate($request, [
            'username'=> 'required',
            'password'=> 'required'
        ]);

        $data = [
            "username"=> $request->username,
            "password"=> $request->password
        ];

        if(Auth::guard('admin')->attempt($data)){
            return redirect(); // TODO: redirect to admin page
        }

        return back()->withErrors(["error"=> "Invalid credentials"]);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(url('admin/login'));
    }
}
