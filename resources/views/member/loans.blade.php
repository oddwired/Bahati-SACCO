@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">
                <nav class="nav navbar-light navbar-toggleable-sm">
                    <div class="flex-column mt-md-0 mt-4 pt-md-0 pt-4" id="navbarWEX">
                        <a class="nav-link" href="{{url('member')}}"><span class="fa fa-home"></span>Dashboard</a>
                        <a href="{{url('member/vehicles')}}" class="nav-link">Vehicles</a>
                        <a href="{{url('member/reports')}}" class="nav-link">Reports</a>
                        <a href="{{url('member/loans')}}" class="nav-link navbar-brand active">Loans</a>
                    </div>
                </nav>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-11 col-xl-11">
                @if(session('info'))
                    <div class="row justify-content-center">
                        <div class="alert alert-success">
                            {{session('info')}}
                        </div>
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Your Loans</div>
                            <div class="card-body">
                                <div class="row justify-content-end">
                                    <a href="{{url('member/apply-loan')}}">Apply for a loan</a>
                                </div>
                                <div class="row justify-content-center" style="margin-top: 20px;">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Loan Amount(KSH)</th>
                                            <th>Monthly repayment (KSH)</th>
                                            <th>Repayment Period (Months)</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($loans as $loan)
                                            <tr>
                                                <td>{{(new DateTime($loan->created_at))->format('d/m/Y')}}</td>
                                                <td>{{$loan->amount}}</td>
                                                <td>{{$loan->monthly_repayment_amount}}</td>
                                                <td>{{$loan->repayment_period}}</td>
                                                <td>
                                                    <span
                                                    @if($loan->status == 1)
                                                        class="badge badge-secondary">{{__('Pending')}}
                                                    @elseif($loan->status == 2)
                                                        class="badge badge-primary">{{__('Received')}}
                                                    @elseif($loan->status == 3)
                                                        class="badge badge-success">{{__('Approved')}}
                                                    @elseif($loan->status == 4)
                                                        class="badge badge-danger">{{__('Rejected')}}
                                                    @else($loan->status == 5)
                                                        class="badge badge-info">{{__('Disbursed')}}
                                                    @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="#" onclick="printForm('{{url('member/generate-application-form/'.$loan->serial_number)}}')">print form</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('jscontent')
    <script>
        function printForm(url){
            window.open(url, "Loan Application Form")
        }
    </script>

@endsection