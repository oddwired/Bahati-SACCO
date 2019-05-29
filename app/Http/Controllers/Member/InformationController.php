<?php

namespace BahatiSACCO\Http\Controllers\Member;

use BahatiSACCO\Member;
use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InformationController extends Controller
{
    public function get(){
        $member = Member::find(Auth::guard('member')->id());

        return view('member.profile', ['member'=> $member]);
    }

    public function edit(){
        $member = Member::find(Auth::guard('member')->id());

        return view('member.update_information', ['member'=> $member]);
    }

    public function save(Request $request){
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:50'],
            'middle_name' => ['string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'national_id' => ['required', 'numeric'],
            'phone' => ['required', 'regex:/^(0|\+254|254)7[0-9]{8}$/'],
            'postal_address' => ['required', 'string', 'max:50'],
            'postal_code' => ['required', 'numeric'],
            'postal_town' => ['required', 'string', 'max:50'],
        ]);

        $member = Member::find(Auth::guard('member')->id());

        $member->first_name = strtoupper($request->first_name);
        $member->middle_name = strtoupper($request->middle_name);
        $member->last_name = strtoupper($request->last_name);
        $member->national_id = $request->national_id;
        $member->phone = $request->phone;
        $member->postal_address = strtoupper($request->postal_address);
        $member->postal_code = $request->postal_code;
        $member->postal_town = strtoupper($request->postal_town);

        $member->save();

        return redirect(url('member'));
    }
}
