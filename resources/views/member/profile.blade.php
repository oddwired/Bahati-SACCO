@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('info'))
                    <div class="row justify-content-center">
                        <div class="alert alert-success">
                            {{session('info')}}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <div class="row justify-content-center">
                                    {{$member->first_name}} {{$member->middle_name}} {{$member->last_name}}
                                </div>
                                <div class="row justify-content-start">
                                    <b>ID: </b> {{$member->national_id}}
                                </div>

                                <div class="row justify-content-start">
                                    <b>Email: </b> {{$member->email}}
                                </div>

                                <div class="row justify-content-start">
                                   <b>Phone </b> {{$member->phone}}
                                </div>
                                <div class="row justify-content-start">
                                    <b>Address: </b> {{$member->postal_address}} - {{$member->postal_code}}, {{$member->postal_town}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection