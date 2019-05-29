@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">
                <nav class="nav navbar-light navbar-toggleable-sm">
                    <div class="flex-column mt-md-0 mt-4 pt-md-0 pt-4" id="navbarWEX">
                        <a class="nav-link" href="{{url('member')}}"><span class="fa fa-home"></span>Dashboard</a>
                        <a href="{{url('member/vehicles')}}" class="nav-link  navbar-brand active">Vehicles</a>
                        <a href="{{url('member/reports')}}" class="nav-link">Reports</a>
                        <a href="{{url('member/loans')}}" class="nav-link">Loans</a>
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
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">Add New Vehicle
                            </div>
                            <div class="card-body">
                                <form action="{{url('member/add-vehicle')}}" method="post">
                                    <div class="form-group row">
                                        @csrf
                                        <label for="registration" class="col-md-4 col-form-label text-md-right">{{ __('Vehicle registration') }}</label>

                                        <div class="col-md-6">
                                            <input id="registration" type="text" class="form-control{{ $errors->has('registration') ? ' is-invalid' : '' }}" name="registration" value="{{ old('registration') }}"
                                                   placeholder="E.g: KBC 123 or KBC 123A" onkeyup="validateRegistration()" required autofocus>

                                            @if ($errors->has('registration'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('registration') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('Capacity') }}</label>

                                        <div class="col-md-6">
                                            <input id="capacity" type="number" class="form-control{{ $errors->has('capacity') ? ' is-invalid' : '' }}" name="capacity" value="{{ __('14') }}" required autofocus>

                                            @if ($errors->has('capacity'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('capacity') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <button class="btn btn-primary">Add Vehicle</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">My vehicles</div>
                            <div class="card-body">
                                <div class="row justify-content-start">

                                </div>
                                <table class="table" id="vehicleTable">
                                    <thead>
                                        <tr>
                                            <th>Vehicle Registration</th>
                                            <th>Capacity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vehicles as $vehicle)
                                            <tr>
                                                <td>{{$vehicle->registration}}</td>
                                                <td>{{$vehicle->capacity}}</td>
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

@endsection
@section('jscontent')
    <script>
        function validateRegistration(){
            var reg = $('#registration');
            reg.val(reg.val().toUpperCase());
        }

        $(document).ready(function (){
            $('#vehicleTable').dataTable();
        });
    </script>
@endsection
