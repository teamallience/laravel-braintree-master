<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;


class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    protected $fillable = [
        'name', 'email', 'password', 'password_temp', 'timezone', 'code', 'active', 'low_balance_worth', 'low_balance_limit', 'card_last_hour', 'trial_ends_at', 'rate', 'allow_payments'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function PaymentMethods(){
        return $this->hasMany('App\PaymentMethod', 'user_id')->orderBy('main', 'desc');
    }

    

    public function Subscriptions(){
        return $this->hasMany('App\Subscription', 'user_id');

    }

    public function Transactions(){
        return $this->hasMany('App\Transaction', 'user_id');
    }

    public function Stats(){
        return $this->hasOne('App\Stats', 'user_id');
    }

    public function ChartData(){
        return $this->hasMany('App\Chart', 'user_id');
    }

    public function StatsSonic(){
        return $this->hasOne('App\StatsSonic', 'user_id');
    }

}
