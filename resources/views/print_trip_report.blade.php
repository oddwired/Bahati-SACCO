@extends('layouts.basic')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <h3>{{config('APP_NAME', 'Bahati SACCO')}}</h3>
        </div>
        <div class="row justify-content-center">
            <h5>Report for <b>{{$conductor->first_name}} {{$conductor->last_name}}</b></h5>
        </div>
        <div class="row justify-content-center">
            <p>from <b>{{ (new DateTime($start_date))->format('d/m/Y') }}</b> to <b>{{ (new DateTime($end_date))->format('d/m/Y') }}</b></p>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Car registration</th>
            <th>Amount collected</th>
            <th>SACCO Charge</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trips as $trip)
            <tr>
                <td>{{(new DateTime($trip->created_at))->format('d/m/Y')}}</td>
                <td>{{(new DateTime($trip->created_at))->format('H:i')}}</td>
                <td>{{$trip->vehicle->registration}}</td>
                <td>{{$trip->total_amount}}</td>
                <td>{{$trip->sacco_charge}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('jscontent')
    <script>
        $(document).ready(function(){
            window.print();
        });
    </script>
@endsection