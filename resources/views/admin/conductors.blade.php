@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-1 col-xl-1">
                <nav class="nav navbar-light navbar-toggleable-sm">
                    <div class="flex-column mt-md-0 mt-4 pt-md-0 pt-4" id="navbarWEX">
                        <a class="nav-link" href="{{url('admin')}}"><span class="fa fa-home"></span>Dashboard</a>
                        <a href="{{url('admin/members')}}" class="nav-link">Members</a>
                        <a href="{{url('admin/conductors')}}" class="nav-link navbar-brand active">Conductors</a>
                        <a href="{{url('admin/conductor-reports')}}" class="nav-link">Conductor reports</a>
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
                            <div class="card-header">Registered Conductors</div>
                            <div class="card-body">
                                <div class="row justify-content-start">
                                    <button class="btn btn-primary" style="margin-bottom: 20px; margin-left: 20px;" data-toggle="modal" data-target="#newConductorModal">Add new</button>
                                </div>

                                <table class="table" id="membersTable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Registered on</th>
                                        <th>Trips Recorded</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($conductors as $conductor)
                                        <tr>
                                            <td>{{$conductor->first_name}} {{$conductor->last_name}} </td>
                                            <td>{{$conductor->email}}</td>
                                            <td>{{(new DateTime($conductor->created_at))->format('d/m/Y')}}</td>
                                            <td>{{count($conductor->trips)}}</td>
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

    <div class="modal fade" id="newConductorModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Conductor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btnclose">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('admin/register-conductor')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="firstName" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstName" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastName" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lastNameName" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button class="btn btn-primary">Register Conductor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jscontent')
    <script>
        $(document).ready(function(){
            @if(count($errors) > 0)
                $('#newConductorModal').modal('show');
            @endif
        });
    </script>
@endsection