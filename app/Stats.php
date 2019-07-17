<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stats extends Model
{
    protected $table = 'stats';

    protected $fillable = ['user_id', 'balance', 'spent_today', 'asr', 'canceled_calls', 'billed_minutes', 'total_calls', 'connected_calls', 'short_calls'];

    public function Owner(){
    	return $this->belongsTo('App\User', 'user_id');
    }

}
