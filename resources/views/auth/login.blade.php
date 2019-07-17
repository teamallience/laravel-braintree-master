@extends('layouts.auth')
@section('title')
    Sign In
@endsection

@section('content')
    <div class="login-register" style="background: #272c33;">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="{{ URL::route('sign-in-post') }}"  method="POST">
                    {{ csrf_field() }}
                    <h3 class="box-title m-b-20">Sign In</h3>
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Error!</strong>
                            {{ (Session::get('error') == 'invalid-account') ? 'Invalid email and/or password. Please try again.' : '' }}
                            @if (Session::get('error') == 'account-doesnt-exist')
                                Account does not exist. Please try again or
                                <a href="/#signup">Sign Up</a>
                            @endif
                            {{ (Session::get('error') == 'inactive-account') ? 'Account not active, please check your email and activate.' : '' }}
                            {{ (Session::get('error') == 'unexpected-error') ? 'Unexpected error occurred. Please try again.' : '' }}
                            {{ (Session::get('error') == 'unactive-account') ? 'Unexpected error occurred while activating your account. Please try again later.' : '' }}
                        </div>
                    @endif

                    @if(Session::get('status')!= '')
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Success!</strong> 
                            {{ Session::get('description') }}
                        </div>
                    @endif

                    <div class="form-group {{$errors->has('email') ? 'has-error': ''}}">
                        <div class="col-xs-12">
                            <input class="form-control" name="email" type="email" required="" placeholder="Email Address" value="{{old('email')}}"> </div>
                    </div>
                    <div class="form-group {{$errors->has('password') ? 'has-error': ''}}">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Password"> </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-info pull-left p-t-0">
                                <input type="checkbox" name="remember" class="filled-in chk-col-light-blue" {{old('remember') ? 'checked': ''}}>
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                            <a href="{{url('/account/forgot-password')}}" class="pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="offset-1 col-10">
                            <a href="{{url('/terms')}}">Terms and Policy</a>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20">
                            <button class="btn btn-block btn-lg btn-success btn-rounded" type="submit">Log In</button>
                        </div>
                    </div>
                    
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            Don't have an account? <a href="/#signup" class="m-l-5"><b>Sign Up</b></a>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection