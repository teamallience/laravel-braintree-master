<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
	public function updateDB(){
		$transactions = Transaction::where('type', '=', 1)->get();
	    foreach ($transactions as $key => $value) {
	        $transaction = Transaction::find($value->id);
	        $transaction->credit = $transaction->credit * 97 / 100;
	        $transaction->save();
	    }	
	}
    
}
