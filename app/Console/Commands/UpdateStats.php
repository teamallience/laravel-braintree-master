<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Pusher\Pusher;

use App\Stats;
use App\User;
use Auth;

class UpdateStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updateStats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is for update stats';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $key => $user) {
            $stats = Stats::where('user_id', '=', $user->id)->get();
            if(count($stats) > 0 ){
                $stats = $stats->first();
            }else{
                $stats = new Stats;
                $stats->user_id = $user->id;
            }
            $stats->balance = mt_rand(-100,100);
            $stats->available_credit = mt_rand(0,150);
            $stats->current_due = mt_rand(0,50);
            $stats->past_due = mt_rand(0,100);
            $stats->terms = "PostPaid";
            $stats->asr = mt_rand(0,100);
            $stats->requests_cancelled = mt_rand(0,100);
            $stats->billed_minutes = mt_rand(1000,2000);
            $stats->total_calls = mt_rand(500,1000);
            $stats->connected_calls = mt_rand(4000,8000);
            $stats->short_calls = mt_rand(0,100);
            $stats->save();
        }
        
        
        
        $options = array(
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'encrypted' => config('broadcasting.connections.pusher.options.encrypted')
        );
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            $options
        );
        foreach ($users as $key => $user) {
            $stats = Stats::where('user_id', '=', $user->id)->first();
            $pusher->trigger('client-dashboard', 'get-stats' . $user->id, $stats);
        }
    }
}
