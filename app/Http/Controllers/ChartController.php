<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Pusher\Pusher;
use App\User;
use App\Chart;
use Carbon\Carbon;

class ChartController extends Controller
{

	public function getUpdate(Request $request){

        $chartdata = Chart::where('user_id', '=', Auth::id())->orderBy('created_at', 'DESC')->limit(30)->get();
        $data = array();
        foreach ($chartdata as $key => $value) {
            $value->created_at = Carbon::parse($value->created_at)->setTimezone(Auth::user()->timezone);
            array_push($data, $value);
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

        $pusher->trigger('client-dashboard', 'get-chart'. Auth::id(), $data);
       
	}
	    
}
