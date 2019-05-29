@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                <nav class="nav navbar-light navbar-toggleable-sm">
                    <div class="flex-column mt-md-0 mt-4 pt-md-0 pt-4" id="navbarWEX">
                        <a class="nav-link navbar-brand active" href="{{url('member')}}"><span class="fa fa-home"></span>Dashboard</a>
                        <a href="{{url('member/vehicles')}}" class="nav-link">Vehicles</a>
                        <a href="{{url('member/reports')}}" class="nav-link">Reports</a>
                        <a href="{{url('member/loans')}}" class="nav-link">Loans</a>
                    </div>
                </nav>
            </div>
            <div class="col-9 col-sm-10 col-md-10 col-lg-11 col-xl-11">
                @if(session('info'))
                    <div class="row justify-content-center">
                        <div class="alert alert-success">
                            {{session('info')}}
                        </div>
                    </div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        Dashboard
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection