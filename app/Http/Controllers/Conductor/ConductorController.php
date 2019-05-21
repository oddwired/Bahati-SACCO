<?php

namespace BahatiSACCO\Http\Controllers\Conductor;

use BahatiSACCO\Conductor;
use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConductorController extends Controller
{
    public function index(){
        return view('conductor.home');
    }

    public function settings(){

    }

    public function updateProfilePicture(Request $request){

    }

    public function updateInformation(Request $request){
        $this->validate($request, [
            'first_name'=> ["required"],
            'last_name'=> ['required'],
        ]);

        $user = Conductor::find(Auth::guard('conductor')->id());

        $user->name = $request->name;

        if($request->has("phone")){
            $user->phone = $request->phone;
        }

        $user->save();

        return redirect(); // TODO: redirect to user profile
    }

    public function getMiniReport(){

    }

    public function getFullReport(){

    }
}
