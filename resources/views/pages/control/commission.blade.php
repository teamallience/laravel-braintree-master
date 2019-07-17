@extends('layouts.dashboard')

@section('styles')
    
@endsection

@section('title')
   Voyyp | Control Panel
@endsection


@section('content')
	
	<div class="card card-body">
		<h2 class="card-title">Voyyp / Cam Wilson</h2>
		<h5 class="m-b-10">Commission Earned: ${{$earned}}</h5>
		<h5 class="m-b-10">Payment Pending: ${{$earned}} </h5>
		<div class="row m-t-20">
		    <div class="col-md-12 col-sm-12">
	        	<h3 class="m-b-10">Clients</h4>
	        	<div class="table-responsive">
	        		<table class="table" style="font-size: 13px;">
		        		<thead>
		        			<td>#</td>
			    	        <td>Name</td>
			    	        <td>Email</td>
			    	        <td>Commission</td>
			    	        <td>Voyyp Balance</td>
			    	        <td>Sonic Balance</td>
			    	        <td>Balance Difference</td>
			    	        <td>Minutes (Today)</td>
			    	        <td>Commission (Today)</td>
		        		</thead>
		        		<tbody>
		        			@foreach($accounts as $account)
		        				<tr>
		        					<td>{{ $account->id }}</td>
		        					<td>{{ $account->name }}</td>
		        					<td>{{ $account->email }}</td>
		        					<td>${{ $account->rate_commission }}</td>
		        					<td>${{ number_format($account->Stats->balance  , 2 , ".", ",")}}</td>
		        					<td>${{ number_format($account->StatsSonic->balance , 2 , ".", ",")}} </td>
		        					<td>${{ number_format($account->Stats->balance - $account->StatsSonic->balance , 2 , ".", ",")}}</td>
		        					<td>{{ number_format($account->Stats->billed_minutes , 2 , ".", ",")}}</td>
		        					<td>${{ number_format($account->rate_commission * $account->Stats->billed_minutes, 2 , ".", ",") }}</td>
		        				</tr>
		        			@endforeach
		        		</tbody>
		        	</table>
	        	</div>
		    </div>
		</div>

	</div>
	
	


@endsection

@section('page_scripts')

@endsection

@section('scripts')
    
@endsection