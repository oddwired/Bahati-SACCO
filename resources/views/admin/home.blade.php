@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">
                <nav class="nav navbar-light navbar-toggleable-sm">
                    <div class="flex-column mt-md-0 mt-4 pt-md-0 pt-4" id="navbarWEX">
                        <a class="nav-link navbar-brand active" href="{{url('admin')}}"><span class="fa fa-home"></span>Dashboard</a>
                        <a href="{{url('admin/members')}}" class="nav-link">Members</a>
                        <a href="{{url('admin/conductors')}}" class="nav-link">Conductors</a>
                        <a href="{{url('admin/conductor-reports')}}" class="nav-link">Conductor reports</a>
                        <a href="{{url('admin/loans')}}" class="nav-link">Loans</a>
                    </div>
                </nav>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-11 col-xl-11">
                <div class="row justify-content-center">
                    <h2>Hello There</h2>
                </div>

            </div>
        </div>
    </div>
@endsection