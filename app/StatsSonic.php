<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatsSonic extends Model
{
    protected $table = 'stats_sonic';

    protected $fillable = ['user_id', 'commission_id', 'username', 'password', 'account_name', 'rate', 'cookie', 'customer_id', 'balance', 'spent_today', 'available_credit', 'current_due', 'terms', 'asr', 'canceled_calls', 'billed_minutes', 'total_calls', 'connected_calls', 'short_calls'];
    public function Account(){
    	return $this->belongsTo('App\User', 'user_id');
    }
}
