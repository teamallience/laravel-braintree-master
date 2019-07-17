@extends('layouts.auth')

@section('title')
    Voyyp | Reset Password
@endsection

@section('content')
        <div class="login-register" style="background: #272c33">
            <div class="login-box card">
                <h3 class="box-title m-b-20">Reset Password</h3>

                <div class="card-body">
                    <form class="form-horizontal form-material" method="POST" action="{{ url('/account/recover-password') }}">
                        {{ csrf_field() }}
                        
                        <input type="hidden" name="recover_token" value="{{$user->code}}">
                        <div class="form-group {{ $errors->has('password') ? ' error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control" name="email" type="email" value="{{$user->email}}"  disabled> 
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" type="password" required="" placeholder="Password" > 
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? ' error' : '' }}">
                            <div class="col-xs-12">
                                <input class="form-control" name="password_confirmation" type="password" required="" placeholder="Password Confirmation" > 
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-rounded">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
