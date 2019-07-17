<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatsDaily extends Model
{
    protected $table = 'stats_daily';

    protected $fillable = ['user_id', 'date', 'billed_minutes', 'sonic_spent', 'commission_owed'];
}
