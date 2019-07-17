@extends('layouts.dashboard')

@section('styles')
    <link href="{{url('css/admin/pages/tab-page.css')}}" rel="stylesheet">
    <link href="{{url('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('plugins/kenkeiter-skeuocard/styles/skeuocard.reset.css')}}" />
    <link rel="stylesheet" href="{{url('plugins/kenkeiter-skeuocard/styles/skeuocard.css')}}" />
    <link rel="stylesheet" href="{{url('plugins/bootstrap-switch/bootstrap-switch.min.css')}}" />
@endsection

@section('title')
   Balance
@endsection


@section('content')
    
    @if($balance < 0)
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="alert alert-danger font-weight-bold">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <p class="text-center">
                            Your account balance is currently negative.
                        </p>
                        <p class="text-center">
                            Please add credit immediately to regain access to the dashboard and keep your account active.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Request::session()->get('status') != '')
        <div class="row" >
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="alert alert-{{Request::session()->get('status')}}">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        {{ Request::session()->get('description') }}
                    </div>            
                </div>
            </div>
        </div>
    @endif
    @if(count($errors) > 0 )
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{isset($error->message) ? $error->message : $error}}</li>
                            @endforeach
                        </ul>
                    </div>            
                </div>
            </div>
        </div>
        
    @endif
    
    @if(Auth::user()->allow_payments == 0)
    <div class="row">
        <div class="col-md-6">
            <div class="card card-body">
                <div style="padding: 29px 0 29px">
                    <h2 class="text-center">Your Balance</h2>
                    <h2 class="text-center"><strong class="balance">$<span id="balance">{{number_format($balance ,2, '.', ',')}}</span></strong></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <div style="padding: 49px 32px">
                    Please make payment with ACH, Wire, or Zelle.<br />Contact <a href="mailto:support@voyyp.com">support@voyyp.com</a> for more details.
                </div>
            </div>
        </div>
    </div>
    @else
        @if(count(Auth::user()->PaymentMethods) > 0)
            <div class="row">
                @include('pages.balance.add_credit_component')
            </div>
            <div class="row">
                @include('pages.balance.auto_bill_component')
            </div>
        @endif
        
    
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @include('pages.balance.add_card_component')
            </div>
        </div>
    @endif
    
    <div class="row">
        <div class="col-md-12 col-sm-12">
            @include('pages.balance.billing_history_component')
        </div>
    </div>
    



@endsection

@section('page_scripts')
    <script type="text/javascript" src="https://jstest.authorize.net/v1/Accept.js" charset="utf-8"></script>
    <script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
    <script type="text/javascript" src="{{asset('plugins/loaders/blockui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/bootstrap-switch/bootstrap-switch.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/kenkeiter-skeuocard/javascripts/vendor/cssua.min.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('plugins/kenkeiter-skeuocard/javascripts/skeuocard.min.js')}}"></script>
    
@endsection

@section('scripts')
    <script>
        var clientKey = '{{ config('services.authorize.key') }}'
        var apiLoginID = '{{ config('services.authorize.login') }}'
    </script>
    <script src="{{ asset('plugins/jquery-number-master/jquery.number.js') }}"></script>    
    <script src="{{url(asset('js/client/balance.js'))}}"></script>
@endsection