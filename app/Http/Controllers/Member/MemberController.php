<?php

namespace BahatiSACCO\Http\Controllers\Member;

use BahatiSACCO\Member;
use BahatiSACCO\Vehicle;
use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    //
    public function index(){
        return view('member.home');
    }

    public function myVehicles(){
        $vehicles = Vehicle::where('owner_id', Auth::guard('member')->id())
            ->get();

        $data = [
            "vehicles"=> $vehicles
        ];

        return view('member.my_vehicles', $data);
    }

    public function settings(){

    }

    public function updateProfilePicture(){

    }

    public function updateInformation(Request $request){
        $this->validate($request, [
            'first_name'=> ["required"],
            'last_name'=> ['required'],
        ]);

        $user = Member::find(Auth::guard('member')->id());

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
