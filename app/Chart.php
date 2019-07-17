<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    protected $table = 'charts';

    protected $fillable = ['user_id', 'cps', 'ports', 'active', 'asr'];

    public function Owner(){
    	return $this->belongsTo('App\User', 'user_id');
    }
}
