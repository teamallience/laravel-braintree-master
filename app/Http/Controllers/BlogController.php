<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

class BlogController extends Controller
{
    public function showwelcome(){
    	return view('pages.index');
    }

    public function showterms(){
    	return view('pages.terms');
    }
}
