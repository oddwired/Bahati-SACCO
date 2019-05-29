<?php

namespace BahatiSACCO\Http\Controllers\Admin;

use BahatiSACCO\Http\Controllers\Controller;
use BahatiSACCO\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(){
        $loans = Loan::with('member')->orderBy('created_at', 'desc')
            ->get();

        $data = [
            'loans'=> $loans
        ];

        return view('admin.loans', $data);
    }

    public function update(Request $request){
        $loan = Loan::where('serial_number', $request->serial)
            ->first();

        $loan->status = $request->status;
        $loan->save();

        return back();

    }
}
