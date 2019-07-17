@extends('layouts.auth')

@section('title')
    Sign Up
@endsection

@section('content')

@if(Session::has('success'))
    <div class="alert alert-success">
        <strong>Success!</strong> Your account has been created successfully. Please check your email and activate your
        account in order to start using it.
    </div>
@else
        <div class="login-register" style="background-image:url(/images/bg/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" action="{{ URL::route('sign-up-post') }}" method="POST">
                        {{ csrf_field() }}
                        <h3 class="box-title m-b-20">Sign Up</h3>
                        @if(Session::has('unex-error'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Error!</strong> An unexpected error took place. It has been reported. Please try again later.
                            </div>
                        @endif
                        <div class="form-group {{$errors->has('name') ? 'has-error': ''}}">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Name" name="name" value="{{old('name')}}">
                                @if($errors->has('name'))
                                    <span class="help-block">
                                        {{$errors->first('name')}}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('email') ? 'has-error': ''}}">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email" name="email" value="{{old('email')}}">
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        {{$errors->first('email')}}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{$errors->has('password') ? 'has-error': ''}}">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="password" placeholder="Password">
                                @if($errors->has('password'))
                                    <span class="help-block">
                                        {{$errors->first('password')}}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="checkbox checkbox-success p-t-0">
                                    <input id="checkbox-signup" type="checkbox"  class="filled-in chk-col-light-blue">
                                    <label for="checkbox-signup"> I agree to all <a href="javascript:void(0)">Terms</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center p-b-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Already have an account? <a href="{{url('login')}}" class="text-info m-l-5"><b>Sign In</b></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endif
@endsection
