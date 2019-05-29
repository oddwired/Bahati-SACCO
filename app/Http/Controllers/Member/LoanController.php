<?php

namespace BahatiSACCO\Http\Controllers\Member;

use BahatiSACCO\Loan;
use BahatiSACCO\Member;
use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

class LoanController extends Controller
{
    public function index(){
        $loans = Loan::where('member_id', Auth::guard('member')->id())->get();

        return view('member.loans', ['loans'=> $loans]);
    }

    public function applyIndex(){
        return view('member.loan_application');
    }

    public function apply(Request $request){
        $this->validate($request, [
            "amount"=> ['required', 'numeric'],
            "repayment_amount"=> ['required', 'numeric'],
            "repayment_period"=> ['required', 'numeric'],
            "bank_name"=> ['required', 'string', 'max:100'],
            "bank_branch"=> ['required', 'string', 'max:100'],
            "bank_account_name"=> ['required', 'string', 'max:100'],
            "bank_account_number"=> ['required', 'numeric']
        ]);

        $member_id = Auth::guard('member')->id();

        $data = [
            "member_id"=> $member_id,
            "amount"=> $request->amount,
            "monthly_repayment_amount"=> $request->repayment_amount,
            "repayment_period"=> $request->repayment_period,
            "serial_number"=> time().$member_id,
            "bank_name"=> $request->bank_name,
            "bank_branch"=> $request->bank_branch,
            "bank_account_name"=> $request->bank_account_name,
            "bank_account_number"=> $request->bank_account_number
        ];

        if(Loan::create($data)){
            return redirect(url('member/loans')); // TODO: Generate application form
        }

        return back()->with(['error'=> "An error occurred. Please try again later!"]);
    }

    public function generateApplicationForm(Request $request){
        $member = Member::find(Auth::guard('member')->id());
        $loan = Loan::where('serial_number', $request->serial)->first();

        if(!$loan){
            return back();
        }

        //$pdf = PDF::loadView('loans.loan_application_form', ['member'=> $member, 'loan'=> $loan]);

        //return $pdf->download('application_form.pdf');

        return view('loans.loan_application_form', ['member'=> $member, 'loan'=> $loan]);
    }
}
