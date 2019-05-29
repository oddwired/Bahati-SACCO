<?php

namespace BahatiSACCO\Http\Controllers\Admin;

use BahatiSACCO\Member;
use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;

class MembersController extends Controller
{
    public function index(){
        $members = Member::with('vehicles')->get();

        $data = [
            "members"=> $members
        ];
        return view('admin.members', $data);
    }
}
