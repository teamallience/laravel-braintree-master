@extends('admin.layouts.auth')

@section('content')
<div class="login-register">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal form-material" id="loginform" action="{{route('admin.register.store')}}" method="POST">
                {{ csrf_field() }}
                <h3 class="box-title m-b-20">Sign Up</h3>
                <div class="form-group {{$errors->has('username') ? 'has-error': ''}}">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Username" name="username" value="{{old('name')}}">
                    </div>
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-error': ''}}">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required="" name="password" placeholder="Password">
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
                        Already have an account? <a href="{{route('admin.auth.login')}}" class="text-info m-l-5"><b>Sign In</b></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
