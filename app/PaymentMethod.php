<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
  	protected $table = 'payment_methods';
    
    protected $fillable = ['customer_id', 'user_id', 'image', 'method', 'expireDate', 'type'];

    public function Owner(){
    	return $this->belongsTo('App\User', 'user_id');
    }

  
}
