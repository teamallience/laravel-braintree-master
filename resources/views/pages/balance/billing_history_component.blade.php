<?php 
    use Carbon\Carbon;
;?>
<div class="card card-body">
    <h2 class="card-title">Billing History</h2>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 10px">
            US-48 Termination billed at $/{{Auth::user()->rate}}. US-48 Origination billed at $.0059/minute.
            <br />Local DIDs are $5/month. Toll-free DIDs are $6/month.
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table" id="billing-history-table">
                    <thead>
                        <th>Date</th>
                        <th>Payment Method</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </thead>
                    <tbody>
                        @foreach($histories as $index=>$history)
                            <?php
                                $created_at = Carbon::parse($history->created_at);// ->setTimezone(Auth::user()->timezone);
                                $history->amount = number_format($history->amount, 2);
                            ?>
                            @if($history->type == 1)
                                <tr>
                                    <td>{{ $created_at->format('m-d-Y h:i:s A') }}</td>
                                    <td>
                                        {{ $history->payment_method }}
                                         @if (filter_var($history->payment_method, FILTER_VALIDATE_EMAIL))
                                            <img src="https://assets.braintreegateway.com/payment_method_logo/paypal.png?environment=production" style="max-height: 23px;">
                                         @endif 
                                    </td>
                                    <td>
                                        ${{ number_format($history->credit, 2) }} credit added
                                    </td>
                                    <td style="color: green">&nbsp;&nbsp;${{ $history->amount }}</td>
                                </tr>
                            @elseif($history->type == 2)
                                <tr>
                                    <td>{{ $created_at->format('m-d-Y h:i:s A') }}</td>
                                    <td>Voyyp Credit</td>
                                    <td>
                                       {{ number_format( ($history->credit * -1) / Auth::user()->rate, 2) }} minutes used
                                    </td>
                                    <td style="color: red">- ${{ $history->amount }}</td>
                                </tr>
                            @elseif($history->type == 3)
                                <tr>
                                    <td>{{ $created_at->format('m-d-Y h:i:s A') }}</td>
                                    <td>Voyyp.com Voucher</td>
                                    <td>
                                       {{ $history->name }}
                                    </td>
                                    <td style="color: green">&nbsp;&nbsp;${{ $history->amount }}</td>
                                </tr>
                            @elseif($history->type == 4)
                                <tr>
                                    
                                    <td>{{ $created_at->format('m-d-Y h:i:s A') }}</td>
                                    <td>Voyyp Credit</td>
                                    <td>
                                     Added {{ $history->amount / 5 }} DIDs @ $5/month
                                    </td>
                                    <td style="color: red">- ${{ $history->amount }}</td>
                                </tr>
                            @elseif($history->type == 5)
                                <tr>
                                    <td>{{ $created_at->format('m-d-Y h:i:s A') }}</td>
                                    <td>Voyyp Credit</td>
                                    <td>
                                       {{ $history->name }}
                                    </td>
                                    <td style="color: red">- ${{ $history->amount }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="text-center">
                        {{$histories->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>