<?php

namespace BahatiSACCO\Http\Controllers\Admin;

use BahatiSACCO\Conductor;
use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;

class ConductorsController extends Controller
{
    public function index(){
        $conductors = Conductor::with('trips')->get();
        $data = [
            "conductors"=> $conductors
        ];
        return view('admin.conductors', $data);
    }
}
