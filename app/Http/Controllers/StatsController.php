<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Pusher\Pusher;
use App\User;
use App\Stats;
use App\Transaction;

class StatsController extends Controller
{
    public function getUpdates(Request $request){
        if(Auth::check()){
            $total = Transaction::where('user_id', '=', Auth::id())->sum('credit');
            $stats = Stats::where('user_id', '=', Auth::id())->first();
            $stats->balance = $total;    
        }else{
            $stats = array();
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
        $pusher->trigger('client-dashboard', 'get-stats' . Auth::id(), $stats);
    }
    // public function getBalance(Request $request){
    //     $total = Transaction::where('user_id', '=', Auth::id())->where('type', '=', 1)->sum('amount') - Transaction::where('user_id', '=', Auth::id())->where('type', '=', 2)->sum('amount');
    //     $stats = array(
    //         'balance' => $total;
    //     );    
        
    //     $options = array(
    //         'cluster' => config('broadcasting.connections.pusher.options.cluster'),
    //         'encrypted' => config('broadcasting.connections.pusher.options.encrypted')
    //     );
    //     $pusher = new Pusher(
    //         config('broadcasting.connections.pusher.key'),
    //         config('broadcasting.connections.pusher.secret'),
    //         config('broadcasting.connections.pusher.app_id'),
    //         $options
    //     );
    //     $pusher->trigger('client-dashboard', 'get-balance' . Auth::id(), $stats);
    // }
}
