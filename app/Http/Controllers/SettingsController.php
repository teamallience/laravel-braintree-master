<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Validator;
use App\User;
use App\Transaction;

class SettingsController extends Controller
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

    public function index(){
    	$page_info['menu'] = 'SETTINGS';
        $page_info['submenu'] = '';
        $balance = Transaction::where('user_id', '=', Auth::id())->sum('credit');

        if($balance < 0) {
            return redirect::to('/balance');
        }
        
        return view('pages.settings.index')
            ->with('balance', $balance)
            ->with('page_info', $page_info);
    }
}
