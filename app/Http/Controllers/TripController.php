<?php

namespace BahatiSACCO\Http\Controllers;

use BahatiSACCO\Trip;
use BahatiSACCO\Vehicle;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    private static function intdiv($a, $b){
        return ($a - $a % $b) / $b;
    }

    public function logTrip(Request $request){
        $this->validate($request, [
            "registration"=> ['required', 'regex:/^K[A-Z][A-Z]\s[0-9][0-9][0-9](|[A-Z])/'],
            "amount"=> ['required', 'numeric']
        ]);

        $vehicle = Vehicle::where('registration', $request->registration)->first();
        if(!$vehicle){
            $vehicle = Vehicle::create(["registration"=>$request->registration]);
        }

        $trip = Trip::create([
            'vehicle_id'=> $vehicle->id,
            'conductor_id'=> Auth::guard('conductor')->id(),
            'total_amount'=> $request->amount,
            'sacco_charge'=> self::intdiv($request->amount * 10, 100)
        ]);

        if(!$trip){
            return back()->withErrors(['error'=> "An error occurred"]);
        }

        return back()->with(['info'=> "Trip recorded successfully!"]);
    }
}
