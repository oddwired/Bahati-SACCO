<?php

namespace BahatiSACCO\Http\Controllers;

use BahatiSACCO\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehiclesController extends Controller
{
    public function create(Request $request){
        $this->validate($request, [
            "registration"=> ['required', 'regex:/^K[A-Z][A-Z]\s[0-9][0-9][0-9](|[A-Z])/', 'unique:vehicles'],
            "capacity"=> ["numeric"]
        ]);

        $new_vehicle = Vehicle::create(["registration"=> $request->registration]);

        if($new_vehicle){
            if(Auth::guard('member')->check())
                $new_vehicle->owner_id = Auth::guard('member')->id();

            if($request->has('capacity'))
                $new_vehicle->capacity = $request->capacity;

            $new_vehicle->save();
        }

        return back()->with(['info'=>"Vehicle added successfully"]);
    }

    public function update(Request $request){

    }

    public function getAllVehicles(){
        $vehicles = Vehicle::all();

    }

    public function getVehicle(Request $request){
        $vehicle = Vehicle::find($request->id);
    }

    public function delete(Request $request){
        $vehicle = Vehicle::find($request->id);
        if ($vehicle)
            $vehicle->delete();

        return back();
    }
}
