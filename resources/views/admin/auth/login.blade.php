@extends('admin.layouts.auth')

@section('content')
    <div class="login-register">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="{{route('admin.auth.loginAdmin')}}" method="POST">
                    {{ csrf_field() }}
                    <h3 class="box-title m-b-20">Admin Sign In</h3>
                    <div class="form-group {{$errors->has('username') ? 'has-error': ''}}">
                        <div class="col-xs-12">
                            <input class="form-control" name="username" type="text" required="" placeholder="Username" value="{{old('username')}}"> </div>
                    </div>
                    <div class="form-group {{$errors->has('password') ? 'has-error': ''}}">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Password"> </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20">
                            <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection