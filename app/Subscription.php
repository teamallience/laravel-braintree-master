<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = ['user_id', 'name', 'braintree_id', 'braintree_plan', 'quantity', 'trial_ends_at', 'ends_at'];

    public function Owner(){
    	return $this->belongsTo('App\User', 'user_id');
    }
}
