<?php

namespace BahatiSACCO\Http\Controllers;

use BahatiSACCO\Conductor;
use BahatiSACCO\Http\Controllers\Admin\ConductorsController;
use BahatiSACCO\Trip;
use BahatiSACCO\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function getTripsRecordedByConductor(Request $request){

        $show = 10;

        if($request->has('show')){
            $show = $request->show;
        }

        $start_date = (new \DateTime())
            ->modify("-7 days")
            ->format('Y-m-d');

        if($request->has('start_date')){
            $start_date = (new \DateTime(preg_replace('/\//', '-', $request->start_date)))
                ->format('Y-m-d');
        }

        $end_date = (new \DateTime())
            ->format('Y-m-d');

        if($request->has('end_date')){
            $end_date = (new \DateTime(preg_replace('/\//', '-', $request->end_date)))
                ->format('Y-m-d');
        }

        $conductor_id = null;

        $is_logged_in = Auth::guard('conductor')->check();
        if($is_logged_in){
            $conductor_id = Auth::guard('conductor')->id();
        }elseif(!$is_logged_in && $request->has('conductor_id')){
            $conductor_id = $request->conductor_id;
        }elseif(Auth::guard('admin')->check()){

            $conductor_id = Conductor::all();

            if (count($conductor_id) == 0){
                $conductor_id = null;
            }else{
                $conductor_id = $conductor_id->random()->id;
            }
        }else{
            return back()->with(['error'=> "Error: Conductor not specified"]);
        }

        if(is_null($conductor_id))
            return back()->with(['error'=> "Error: Conductor not specified"]);

        if($request->has('print')){
            $trips = Trip::with('vehicle')
                ->where('conductor_id', $conductor_id)
                ->whereDate('created_at', ">=", $start_date)
                ->whereDate('created_at', "<=", $end_date)
                ->orderBy('created_at', 'desc')
                ->get();

            $conductor = Conductor::find($conductor_id);

            $data = ['trips'=> $trips,
                'start_date'=> $start_date,
                'end_date'=> $end_date,
                "show"=> $show,
                'conductor'=> $conductor
            ];

            return view('print_trip_report', $data);
        }

        $trips = Trip::with('vehicle')
            ->where('conductor_id', $conductor_id)
            ->whereDate('created_at', ">=", $start_date)
            ->whereDate('created_at', "<=", $end_date)
            ->orderBy('created_at', 'desc')
            ->paginate($show);

        $data = ['trips'=> $trips,
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            "show"=> $show,
            'selected_conductor'=> $conductor_id
            ];

        if(Auth::guard('admin')->check()){

            $conductors = Conductor::all();
            $data['conductors'] = $conductors;

            return view('admin.reports', $data);
        }


        return view('conductor.reports', $data);
    }

    public function getTripRecordsForMember(Request $request){

        $show = 10;

        if($request->has('show')){
            $show = $request->show;
        }

        $start_date = (new \DateTime())
            ->modify("-7 days")
            ->format('Y-m-d');

        if($request->has('start_date')){
            $start_date = (new \DateTime(preg_replace('/\//', '-', $request->start_date)))
                ->format('Y-m-d');
        }

        $end_date = (new \DateTime())
            ->format('Y-m-d');

        if($request->has('end_date')){
            $end_date = (new \DateTime(preg_replace('/\//', '-', $request->end_date)))
                ->format('Y-m-d');
        }

        $order_by = 'created_at';
        $direction = 'desc';

        if($request->has('order_by')){
            switch ($request->order_by){
                case 'date':
                    $order_by = "created_at";
                    break;
                case 'registration':
                    $order_by = 'registration';
                    break;
                case 'amount':
                    $order_by = 'total_amount';
                    break;
                default:
                    $order_by = 'created_at';
            }
        }

        if($request->has('direction')){
            $direction = $request->direction;
        }

        $member_id = null;

        $is_logged_in = Auth::guard('member')->check();
        if($is_logged_in){
            $member_id = Auth::guard('member')->id();
        }elseif(!$is_logged_in && $request->has('member_id')){
            $member_id = $request->member_id;
        }else{
            return back()->with(['error'=> "Error: Member not specified"]);
        }

        $trips = Trip::with(['vehicle', 'vehicle.owner'])
            ->whereHas('vehicle.owner', function($q) use ($member_id){
                $q->where('id', $member_id);
            })
            ->whereDate('created_at', ">=", $start_date)
            ->whereDate('created_at', "<=", $end_date)
            ->orderBy('created_at', 'desc')
            ->paginate($show);

        /*$trips = Trip::with('vehicle')
            ->where('conductor_id', $member_id)
            ->whereDate('created_at', ">=", $start_date)
            ->whereDate('created_at', "<=", $end_date)
            ->orderBy('created_at', 'desc')
            ->paginate($show);*/


        $data = [
            'trips'=> $trips,
            'start_date'=> $start_date,
            'end_date'=> $end_date,
            "show"=> $show
            ];
        return view('member.reports', $data);
    }
}
