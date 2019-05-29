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
                    <div class="card-header">{{ __('Update your information') }}</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $member->first_name }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                                <div class="col-md-6">
                                    <input id="middle_name" type="text" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name" value="{{ $member->middle_name }}" autofocus>

                                    @if ($errors->has('middle_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $member->last_name }}" required autofocus>

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="national_id" class="col-md-4 col-form-label text-md-right">{{ __('National ID') }}</label>

                                <div class="col-md-6">
                                    <input id="national_id" type="text" class="form-control{{ $errors->has('national_id') ? ' is-invalid' : '' }}" name="national_id" value="{{ $member->national_id }}" required autofocus>

                                    @if ($errors->has('national_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('national_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $member->phone }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="postal_address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="postal_address" type="text" class="form-control{{ $errors->has('postal_address') ? ' is-invalid' : '' }}" name="postal_address" value="{{ $member->postal_address }}" required autofocus>

                                    @if ($errors->has('postal_address'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postal_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postal Code') }}</label>

                                <div class="col-md-6">
                                    <input id="postal_code" type="text" class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code" value="{{ $member->postal_code }}" required autofocus>

                                    @if ($errors->has('postal_code'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="postal_town" class="col-md-4 col-form-label text-md-right">{{ __('Town') }}</label>

                                <div class="col-md-6">
                                    <input id="postal_town" type="text" class="form-control{{ $errors->has('postal_town') ? ' is-invalid' : '' }}" name="postal_town" value="{{ $member->postal_town }}" required autofocus>

                                    @if ($errors->has('postal_town'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postal_town') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection