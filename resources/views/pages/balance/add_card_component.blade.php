<?php 
    use Carbon\Carbon;
?>
<div class="card card-body">
    <h2 class="card-title">Payment Method</h2>
        @if(count(Auth::user()->PaymentMethods) != 0)
            <h5 class="m-b-10">All major credit cards are accepted.</h5>
        @endif
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">

                @if(count(Auth::user()->PaymentMethods) == 0)
                    <div class="alert alert-info m-t-10" role="alert">
                      Please add a payment method to continue. We accept all major credit/debit cards and PayPal
                    </div>
                @endif
            </div>
            <div class="col-sm-12 payment-method-list">
                @foreach(Auth::user()->PaymentMethods as $index=>$method)
                    <div class="card payment-method card-body" data-id="{{$method->customer_id}}">
                        <div class="row">
                            @if($method->type != 'paypal')
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                    <div style="font-family: Courier">
                                        <img src="{{ $method->image }}"> &nbsp;{{$method->method}} &nbsp; Expires: {{$method->expireDate}}  
                                        @if($method->main == 1)
                                            &nbsp;  <span class="text-success">Primary Method</span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                    <div style="font-family: Courier">
                                        <img src="{{ $method->image }}"> &nbsp;{{ $method->method }}
                                        @if($method->main == 1)
                                          &nbsp;   <span class="text-success">Primary Method</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-5 col-sm-6 col-xs-12 text-right">
                                @if($method->main != 1)
                                    <a href="{{url('/balance/paymentmethod/'. $method->id .'/setmain')}}" class="btn btn-secondary">Set as Primary</a>
                                @endif
                                @if(count(Auth::user()->PaymentMethods) != 1)
                                    <a href="{{url('/balance/paymentmethod/'. $method->id .'/remove')}}" class="btn btn-danger"><i class="fa fa-close"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach       
            </div>
            <div class="col-sm-12 text-center m-t-20">
                <button class="btn waves-effect waves-light btn-secondary add_credit_btn"  data-toggle="modal" data-target="#add_card_modal">Add Credit/Debit Card</button>
                <form id="add_paypal_form" method="post" action="{{url('/balance/reg_paypal_card')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="payment_method_nonce" id="add_paypal_form_payment_method_nonce">
                    <div id="paypal-container"></div>
                </form>
            </div>
            <div id="add_card_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">                
                    <div class="modal-content">
                        <form class="" id="add_card_form" action="{{url('/balance/reg_card')}}" method="post">
                            {{csrf_field()}}
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <ul class="list-inline list-unstyled payment_methods">
                                    <li><img src="{{asset('img/icon/visa.png')}}" class="payment_img"></li>
                                    <li><img src="{{asset('img/icon/mastercard.png')}}" class="payment_img"></li>
                                    <li><img src="{{asset('img/icon/american-express.png')}}" class="payment_img"></li>
                                    <li><img src="{{asset('img/icon/discover.png')}}" class="payment_img"></li>
                                </ul>
                            </div>

                              <!-- Modal body -->
                            <div class="modal-body">
                                <div class="credit-card-input no-js" id="skeuocard">
                                    <p class="no-support-warning">
                                    Either you have Javascript disabled, or you're using an unsupported browser, amigo! That's why you're seeing this old-school credit card input form instead of a fancy new Skeuocard. On the other hand, at least you know it gracefully degrades...
                                    </p>
                                    <label for="cc_type">Card Type</label>
                                    <select name="cc_type">
                                        <option value="">...</option>
                                        <option value="visa">Visa</option>
                                        <option value="discover">Discover</option>
                                        <option value="mastercard">MasterCard</option>
                                        <option value="maestro">Maestro</option>
                                        <option value="jcb">JCB</option>
                                        <option value="unionpay">China UnionPay</option>
                                        <option value="amex">American Express</option>
                                        <option value="dinersclubintl">Diners Club</option>
                                    </select>
                                    <label for="cc_number">Card Number</label>
                                    <input type="text" name="cc_number" id="cc_number" placeholder="XXXX XXXX XXXX XXXX" maxlength="19" size="19">
                                    <label for="cc_exp_month">Expiration Month</label>
                                    <input type="text" name="cc_exp_month" id="cc_exp_month" placeholder="00">
                                    <label for="cc_exp_year">Expiration Year</label>
                                    <input type="text" name="cc_exp_year" id="cc_exp_year" placeholder="00">
                                    <label for="cc_name">Cardholder's Name</label>
                                    <input type="text" name="cc_name" id="cc_name" placeholder="John Doe">
                                    <label for="cc_cvc">Card Validation Code</label>
                                    <input type="text" name="cc_cvc" id="cc_cvc" placeholder="123" maxlength="4" size="4">
                                </div>
                                <div class="form-group">
                                    <label for="nm">Name</label>
                                    <input type="text" name="name" class="form-control" id="nm">
                                </div>
                                <div class="form-group">
                                    <label for="addr">Address</label>
                                    <input type="text" name="address" class="form-control" id="addr">
                                </div>
                            </div>

                              <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" id="close-btn-test">Close</button>
                                <button class="btn btn-success" id="button-pay" disabled="true">Add Card</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          
            
        </div>
    </div>
</div>