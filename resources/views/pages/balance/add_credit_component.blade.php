<div class="col-md-6">
    <div class="card card-body">
        <div class="row">
            <div class="col-xs-12 offset-sm-2 col-sm-8">
                <form method="post" action="{{url('balance/add_credit_net')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="customerId" value="{{$main_method}}" id="main_method">
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-6">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-size: 20px">$</span>
                                </div>
                                <input type="text" class="form-control text-right" style="font-size: 20px" placeholder="50" aria-label="Amount (to the nearest dollar)" value="{{old('amount') != null ? old('amount') : $last_deposit}}" name="amount">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary waves-effect waves-light m-r-10">Add Credit Now</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="text-align: center; font-size: 13px; padding-top: 10px">
                3% will be deducted. $10 minimum.
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card card-body">
       <div class="row">
            <div class="col-xs-12 offset-sm-2 col-sm-8" style="padding: 29px 0 29px">
                <h2 class="text-center">Your Balance</h2>
                <h2 class="text-center"><strong class="balance">$<span id="balance">{{number_format($balance ,2, '.', ',')}}</span></strong></h2>
            </div>
        </div>
    </div>
</div>