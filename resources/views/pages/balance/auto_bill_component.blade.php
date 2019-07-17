
<div class="col-md-12 col-sm-12">
	<?php
		$autobill_array = config('consts.AUTOBILL');
	?>
    <div class="card card-body">
    	<div class="row">
    		<div class="col-md-12 col-sm-12 col-xs-12">
	    		<div class="float-left">
					<h2 class="card-title">Autobill</h2>
				</div>
				<div class="bt-switch float-right">
					<div >
						<input type="checkbox"  data-on-color="success" data-off-color="warning"  value="1" id="autobill-toggler" {{Auth::user()->autobill_toggler == true ? 'checked' : ''}} {{$main_method_type == 'paypal' ? 'disabled' : ''}}>
					</div>
				</div>
			</div>
		</div>
        <h5 class="m-b-10">
	        Automatically add credit when your balance falls below a certain amount.
	    </h5>
	    @if($main_method_type == 'paypal')
		    <h5 class="m-b-10 text-danger">
		        Autopay cannot be used with paypal.
		    </h5>
	    @endif
        <div class="row" id="autobill-form-wrapper" @if(Auth::user()->autobill_toggler == false) style="display: none;" @endif>
  			<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card payment-method card-body">
	                <div class="row">
                        <div class="col-md-12" style="font-size: 16px; font-family: Courier;">
                        	<form action="{{url('balance/autobill/set_limit')}}" method="post">
                        		{{csrf_field()}}
	                        	<div class="float-left">
	                        		I want to add 
	                    			<select class="autobill worth" name="low_balance_worth">
	                    				@foreach($autobill_array as $worth)
	                    					<option value="{{$worth}}" {{ Auth::user()->low_balance_worth == $worth ? 'selected' : ''}}> ${{$worth}} </option>
	                    				@endforeach
	                    			</select>
	                    			 worth of credit when my balance falls below 
	                    			<select class="autobill limit" name="low_balance_limit">
                    					<?php
                    						$min = 0;
                    						$limits = array_filter(
											    $autobill_array,
											    function ($value) use($min) {
											        return ($value > $min);
											    }
											);
                    					?>
                    					@foreach($limits as $limit)
                    						<option value="{{$limit}}" {{Auth::user()->low_balance_limit == $limit ? 'selected' : ''}}> ${{$limit}} </option>
                    					@endforeach
	                    			</select>
	                    		</div>
	                    		<button class="btn waves-effect waves-light btn-secondary float-right d-none" id="autobill-update-btn">Update</button>
                    		</form>
                        </div>
               		</div>
            	</div>
    		</div>
		</div>
	</div>  
</div>
    	
