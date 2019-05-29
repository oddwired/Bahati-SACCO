@extends('layouts.basic')
@section('csscontent')
    <style>
        h4 {
            margin: 30px;
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <h3>{{config('APP_NAME', 'Bahati SACCO')}}</h3>
        </div>
        <div class="row justify-content-center">
            <h4><u>Loan Application Form</u></h4>
        </div>

        <div class="row">
            <b><u>SERIAL NUMBER:</u> </b> {{$loan->serial_number}}
        </div>

        <div class="row"><h4><u>Applicant details</u></h4></div>
        <div class="row">
            <div class="col-sm">
                <b>Full Name:</b> {{$member->first_name}} {{$member->middle_name}} {{$member->last_name}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <b>National ID: </b> {{$member->national_id}}
            </div>
            <div class="col-sm">
                <b>Mobile Number: </b> {{$member->phone}}
            </div>
            <div class="col-sm">
                <b>Email: </b> {{$member->email}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <b>Postal Address: </b> {{$member->postal_address}}
            </div>
            <div class="col-sm">
                <b>Postal Code: </b> {{$member->postal_code}}
            </div>
            <div class="col-sm">
                <b>Town: </b> {{$member->postal_town}}
            </div>
        </div>
        <div class="row">
            <h4><u>Loan Details</u></h4>
        </div>
        <div class="row">
            <b>Amount Applied for: </b> {{$loan->amount}}
        </div>
        <div class="row">
            <b>Repayment period: </b>  {{$loan->repayment_period}} months at KSh {{$loan->monthly_repayment_amount}} per month
        </div>
        <div class="row">
            <h4><u>Guarantors</u></h4>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>National ID</th>
                    <th>Amount Guaranteed</th>
                    <th>Signature</th>
                </tr>
                </thead>
                <tbody>
                @foreach([1,2,3,4,5,6,7,8,10] as $item)
                    <tr>
                        <td>{{$item}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <h4><u>Terms And Conditions</u></h4>
        </div>
        <div class="row">
            Terms and conditions come here
        </div>
        <div class="row">
            <h4><u>Declaration</u></h4>
        </div>
        <div class="row">
            I ...........................................................................hereby declare that the foregoing particulars are true to the
            best of my knowledge and belief, and agree to abide by the terms and conditions of the Society....(and a lot of other stuff here)

        </div>
        <div class="row">
            <div class="col-sm">
                ID:...............................
            </div>
            <div class="col-sm">
                Signature:..................................
            </div>
            <div class="col-sm">
                Date:.......................................
            </div>
        </div>
    </div>

@endsection
@section('jscontent')
    <script>
        $(document).ready(function(){
            window.print();
        });
    </script>
@endsection