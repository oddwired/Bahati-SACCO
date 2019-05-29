@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">
                <nav class="nav navbar-light navbar-toggleable-sm">
                    <div class="flex-column mt-md-0 mt-4 pt-md-0 pt-4" id="navbarWEX">
                        <a class="nav-link" href="{{url('member')}}"><span class="fa fa-home"></span>Dashboard</a>
                        <a href="{{url('member/vehicles')}}" class="nav-link">My Vehicles</a>
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

                    @if ($errors->has('error'))
                        <div class="row justify-content-center">
                            <div class="alert alert-danger">
                                {{$errors->first('error')}}
                            </div>
                        </div>
                    @endif

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <a href="{{url('member/loans')}}" class="btn btn-primary">Go Back</a>
                        <div class="card">
                            <div class="card-header">Apply for a loan</div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <form action="" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="amount" class="col-md-6 col-form-label text-md-right">{{ __('Amount Applying for') }}</label>

                                            <div class="col-md-6">
                                                <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required autofocus>

                                                @if ($errors->has('amount'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <h5 class="row justify-content-center">Repayment proposal</h5>
                                        <div class="form-group row">

                                            <label for="repayment_amount" class="col-md-6 col-form-label text-md-right">{{ __('Monthly repayment amount') }}</label>

                                            <div class="col-md-6">
                                                <input id="repayment_amount" type="number" class="form-control{{ $errors->has('repayment_amount') ? ' is-invalid' : '' }}" name="repayment_amount" value="{{ old('repayment_amount') }}" required>

                                                @if ($errors->has('repayment_amount'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('repayment_amount') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label for="repayment_period" class="col-md-6 col-form-label text-md-right">{{ __('Repayment period (Months)') }}</label>

                                            <div class="col-md-6">
                                                <input id="repayment_period" type="number" class="form-control{{ $errors->has('repayment_period') ? ' is-invalid' : '' }}" name="repayment_period" value="{{ old('repayment_period') }}" required>

                                                @if ($errors->has('repayment_period'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('repayment_period') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <h5 class="row justify-content-center">Disbursement Details</h5>
                                        <div class="form-group row">

                                            <label for="bank_name" class="col-md-6 col-form-label text-md-right">{{ __('Bank Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="bank_name" type="text" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" name="bank_name" value="{{ old('bank_name') }}" required>

                                                @if ($errors->has('bank_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label for="bank_branch" class="col-md-6 col-form-label text-md-right">{{ __('Branch') }}</label>

                                            <div class="col-md-6">
                                                <input id="bank_branch" type="text" class="form-control{{ $errors->has('bank_branch') ? ' is-invalid' : '' }}" name="bank_branch" value="{{ old('bank_branch') }}" required>

                                                @if ($errors->has('bank_branch'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('bank_branch') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label for="bank_account_name" class="col-md-6 col-form-label text-md-right">{{ __('Account Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="bank_account_name" type="text" class="form-control{{ $errors->has('bank_account_name') ? ' is-invalid' : '' }}" name="bank_account_name" value="{{ old('bank_account_name') }}" required>

                                                @if ($errors->has('bank_account_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('bank_account_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label for="bank_account_number" class="col-md-6 col-form-label text-md-right">{{ __('Account Number') }}</label>

                                            <div class="col-md-6">
                                                <input id="bank_account_number" type="number" class="form-control{{ $errors->has('bank_account_number') ? ' is-invalid' : '' }}" name="bank_account_number" value="{{ old('bank_account_number') }}" required>

                                                @if ($errors->has('bank_account_number'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('bank_account_number') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Apply') }}
                                                </button>
                                            </div>
                                        </div>

                                    </form>

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

        function printReport(){
            var form = $('#parameterForm');
            form.append("<input type='hidden' id='printField' name='print' value='true'>");

            window.open(window.location.protocol + "//"+window.location.host + window.location.pathname + "?" + form.serialize(), "Print Report");

            $('#printField').remove();
        }

        $(document).ready(function(){
            $('#start_date').datepicker({
                dateFormat: "dd/mm/yy",
                altFormat: "yy-mm-dd"
            });

            $('#end_date').datepicker({
                dateFormat: "dd/mm/yy",
                altFormat: "yy-mm-dd"
            });
        });
    </script>
@endsection