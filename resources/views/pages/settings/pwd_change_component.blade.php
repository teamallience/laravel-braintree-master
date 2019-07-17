<div class="card card-body">
    <h2 class="card-title">Change Password</h2>
    @if(Request::session()->get('status') != '')
        <div class="row" >
            <div class="col-md-12 col-sm-12">
                <div class="alert alert-{{Request::session()->get('status')}}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    {{ Request::session()->get('description') }}
                </div>            
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form class="form-horizontal m-t-40" method="post" action="{{url('change-password')}}">
                {{csrf_field()}}
                <div class="form-group {{$errors->has('current_password') ? 'has-danger': ''}}">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="form-control">
                    @if($errors->has('current_password'))
                        <span class="form-control-feedback">
                            {{ $errors->first('current_password') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{$errors->has('password') ? 'has-danger': ''}}">
                    <label for="password">New Password</span></label>
                    <input type="password" id="password" name="password" class="form-control">
                    @if($errors->has('password'))
                        <span class="form-control-feedback">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{$errors->has('password_confirmation') ? 'has-danger': ''}}">
                    <label>Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" value="">
                    @if($errors->has('password_confirmation'))
                        <span class="form-control-feedback">
                            {{ $errors->first('password_confirmation') }}
                        </span>
                    @endif
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10"> Submit </button>
                </div>
            </form>
        </div>
    </div>
</div>