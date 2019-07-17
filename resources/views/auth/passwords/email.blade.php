@extends('layouts.auth')

@section('title')
    Voyyp | Forget Password
@endsection

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            We have sent you instructions in your email in order to recover your account.
        </div>
    @else
        <div class="login-register"  style="background: #272c33;">
            <div class="login-box card">
                <div class="card-body">
                     @if (session('status') != '')
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('description') }}
                        </div>
                    @endif
                    <form class="form-horizontal" id="recoverform" method="POST" action="{{ URL::route('forgot-password-post') }}">
                        {{ csrf_field() }}
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Error!</strong>
                            {{ (Session::get('error') == 'invalid-email') ? 'Invalid email. Please try again.' : '' }}
                            @if (Session::get('error') == 'account-doesnt-exist')
                                Account does not exist. Please try again or
                                <a href="/#signup">Sign Up</a>
                            @endif
                            {{ (Session::get('error') == 'inactive-account') ? 'Account not active, please check your email and activate.' : '' }}
                            {{ (Session::get('error') == 'unexpected-error') ? 'Unexpected error occurred. Please try again.' : '' }}
                        </div>
                    @endif
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control" id="email" name="email" value="{{old('email')}}" type="text" required="" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-success btn-rounded btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    @endif
@endsection
