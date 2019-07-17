<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Carbon\Carbon;

use App\StatsDaily;

use App\PaymentMethod;


class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['user_id', 'amount','credit', 'type' , 'customer_id', 'payment_method'];

    public function Owner(){
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function Description(){
    	if($this->type == 1){
    		$mins = number_format($this->credit / 0.006 ,2, '.', ',');
            $descrip = '$' . number_format($this->credit, 2 ,'.', ',') . 'credit was added';
    		return $descrip;
    	}else if($this->type == 4){
            $descrip = 'Added' . number_format($this->amount / 5, 2,'.', ',') . 'DIDs @ $5/month';
            return $descrip;
        }else{
    		$date = date('Y-m-d', strtotime($this->created_at));
    		$daily = StatsDaily::where('user_id', '=', $this->user_id)->where('date', '=', $date)->first();
    		$billed_minutes = number_format($daily->billed_minutes ,2, '.', ',');
    		return 'Used ' . $billed_minutes . ' minutes';
    	}
    }
}
