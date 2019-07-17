<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Pusher\Pusher;

use App\Chart;
use App\User;


class UpdateChartData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updatechart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Chart Data Table';

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
            
            $chartdata = new Chart;
            $chartdata->user_id = $user->id;
            $chartdata->cps = mt_rand(0, 20);
            $chartdata->ports = mt_rand(0, 250);
            $chartdata->active = mt_rand(0, 150);
            $chartdata->asr = mt_rand(0,100);
            $chartdata->save();
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
            $chartdata = Chart::where('user_id', '=', $user->id)->orderBy('created_at')->limit(30);

            $pusher->trigger('client-dashboard', 'get-chart' . $user->id, $chartdata);
        }
        
    }
}
