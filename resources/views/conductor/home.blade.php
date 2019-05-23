@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">
                <nav class="nav navbar-light navbar-toggleable-sm">
                    <div class="flex-column mt-md-0 mt-4 pt-md-0 pt-4" id="navbarWEX">
                        <a class="nav-link navbar-brand active" href="{{url('conductor')}}"><span class="fa fa-home"></span>Home</a>
                        <a href="{{url('conductor/reports')}}" class="nav-link">Reports</a>
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

                @if($errors->has('error'))
                    <div class="row justify-content-center">
                        <div class="alert alert-success">
                            {{$errors->first('error')}}
                        </div>
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <div class="card">
                            <div class="card-header">Record a trip</div>
                            <div class="card-body">
                                <form action="{{url('conductor/record-trip')}}" method="post">
                                    @csrf
                                    <div class="form-group row">

                                        <label for="registration" class="col-md-4 col-form-label text-md-right">{{ __('Vehicle registration') }}</label>

                                        <div class="col-md-6">
                                            <input id="registration" type="text" list="registrations" class="form-control{{ $errors->has('registration') ? ' is-invalid' : '' }}" name="registration" value="{{ old('registration') }}"
                                                   placeholder="E.g: KBC 123 or KBC 123A" onkeyup="validateRegistration()" required autofocus>

                                            <datalist id="registrations">
                                                @foreach($vehicles as $vehicle)
                                                    <option value="{{$vehicle->registration}}"></option>
                                                @endforeach
                                            </datalist>
                                            @if ($errors->has('registration'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('registration') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">

                                        <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Total Amount') }}</label>
                                        <div class="input-group col-md-6">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">{{__('KSH')}}</span>
                                            </div>
                                            <input id="amount" type="number" min="0.01" step="0.01" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" required autofocus>
                                            @if ($errors->has('amount'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row justify-content-center">
                                        <button type="submit" class="btn btn-primary">{{__('Record')}}</button>
                                    </div>
                                </form>
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
        function validateRegistration(){
            var reg = $('#registration');
            reg.val(reg.val().toUpperCase());
        }
    </script>
@endsection