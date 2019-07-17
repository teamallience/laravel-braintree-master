<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;

use Carbon\Carbon;
use App\Chart;
use App\Product;
use App\Transaction;
use App\StatsDaily;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.index');
    }
    public function dashboard(){
        $page_info['menu'] = 'DASHBOARD';
        $page_info['submenu'] = '';
        $balance = Transaction::where('user_id', '=', Auth::id())->sum('credit');

        if($balance < 0) {
            return redirect::to('/balance');
        }
        
        $chartdata = Chart::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->limit(30)->get();
        $data = array();
        foreach ($chartdata as $key => $value) {
            $value->created_at = Carbon::parse($value->created_at)->setTimezone(Auth::user()->timezone);
            array_push($data, $value);
        }
        
        return view('pages.dashboard.dashboard')
            ->with('chartdata', $data)
            ->with('balance', $balance)
            ->with('page_info', $page_info);
    }

    public function commission(){
        $page_info['menu'] = 'DASHBOARD';
        $page_info['submenu'] = '';
        $balance = Transaction::where('user_id', '=', Auth::id())->sum('credit');
        $spent['sonic'] = StatsDaily::sum('sonic_spent');
        $spent['commission'] = StatsDaily::sum('commission_owed');
        $spent['vitelity'] = 6.5;
        $spent['2captcha'] = 20;
        $spent['total'] = array_sum(array_values($spent));

        $total['revenue'] = Transaction::where('type', '=', 1)->sum('amount') - Transaction::where('type', '=', 1)->sum('fees_paid');
        $total['charged'] = Transaction::where('type', '=' , 2)->sum('amount');
        $accounts = User::where('active', '=', 1)->get();
        $earned = StatsDaily::where('referrer_id', '=', 1)->sum('commission_owed');
        return view('pages.control.commission')
            ->with('page_info', $page_info)
            ->with('spent', $spent)
            ->with('total', $total)
            ->with('balance', $balance)
            ->with('earned', $earned)
            ->with('accounts', $accounts);
    }

    

}
