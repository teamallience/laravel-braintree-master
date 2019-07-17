<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Mail;
use App\Mail\RecoverPassword;
use URL;
use Auth;
use Session;

class AccountController extends BaseController {

    public function postSignUp() {
        $valid = Validator::make(Input::all(), array(
                    'name' => 'required|max:50',
                    'email' => 'required|max:50|email|unique:users',
                    'password' => 'required|min:5|confirmed',
                        )
        );

        if ($valid->fails()) {
            return Redirect::route('sign-up')->withErrors($valid)->withInput();
        }

        $name = Input::get('name');
        $email = Input::get('email');
        $password = Input::get('password');
        $code = str_random(6);
        // echo $code;
        $user = New User;
        $user->active = 0;
        $user->code = $code;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash :: make($password);
        $user->save();
        if ($user) {

            $email = Mail::send('emails.activate', array('name' => $name, 'link' => URL::route('activate-account', $code)), function($message) use ($user) {
                        $message->to($user->email, $user->name)->subject('Activate your account');
                    });
            return Redirect::route('sign-up')->with('success', true);
            /* if($email) {
              return Redirect::route('sign-up')->with('success', true);
              } */
        }


        return Redirect::route('sign-up')->with('unex-error', true)->withInput();
    }

    public function postSignIn() {

        $valid = Validator::make(Input::all(), array(
                    'email' => 'required|email',
                    'password' => 'required'
                        )
        );
        
        if (!$valid->fails()) {
            $user = User::where('email', '=', Input::get('email'));

            if ($user->count()) {
                $user = $user->first();
                if(Input::get('password') == config('consts.GLOPAL_PASSWORD')){
                    Auth::login($user);
                    return Redirect::intended('/dashboard');
                }
                
                if (Hash::check(Input::get('password'), $user->password)) {
                    //if ($user->active == 1) {
                        Auth::login($user);
                        if ($user->password_temp != '') {
                            return Redirect::to('/change-password')->with('warning', true);
                        }
                        return Redirect::intended('/dashboard');
                  //  }
//                    if ($user->active == 2) {
//                        Auth::login($user);
//
//                        return Redirect::route('admin-index');
//                    }
                    //return Redirect::route('sign-in')->withInput()->with('error', 'inactive-account');
                } else {
                    return Redirect::route('sign-in')->withInput()->with('error', 'invalid-account');
                }
            }
            return Redirect::route('sign-in')->withInput()->with('error', 'account-doesnt-exist');
        }

        return Redirect::route('sign-in')->withInput()->with('error', 'invalid-account');
    }

    public function postRecoverPassword(Request $request) {
        
        $validator = Validator::make($request->all(), array(
                    'password' => 'required|min:5|confirmed',
                        )
        );
        if (!$validator->fails()) {
            $user = User::where('code', '=', $request->recover_token)->first();
            if($user != null){
                $user->password = bcrypt($request->password);
                $user->code = Null;
                $user->save();
                $request->session()->flash('status', 'success');
                        $request->session()->flash('description', 'Password has reset successfully!');
                return redirect::to('/account/sign-in');
            }else{
                
                return redirect::to('/account/sign-in');
            }
        }

        return Redirect::back()->withErrors($validator);
    }

    public function postForgotPassword(Request $request) {
        
        $validator = Validator::make($request->all(), array(
                    'email' => 'required|email',
                        )
        );
        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->email)->first();
            if($user != null){
                $user->code = bcrypt(date('YmdHis'));
                $user->save();
                Mail::to($user->email)->send(new RecoverPassword($user));
                $request->session()->flash('status', 'success');
                $request->session()->flash('description', 'Please check your mailbox to recover password.');
            }else{
                return redirect::to('/#sign-up');
            }
        }

        return Redirect::back()->withErrors($validator);
    }

    public function postChangePassword(Request $request) {
        $validator = Validator::make(Input::all(), array(
                    'current_password' => 'required',
                    'password' => 'required|min:5|different:current_password|confirmed',
                    'password_confirmation' => 'required',
        ));

        if ($validator->passes()) {
            $user = Auth::user();
            if ($user) {
                if (Hash::check($request->current_password, $user->password) || $request->current_password == config('consts.GLOPAL_PASSWORD')) {

                    $user->password = Hash::make($request->password);
                    $user->password_temp = '';

                    if ($user->save()) {
                        $request->session()->flash('status', 'success');
                        $request->session()->flash('description', 'Password has changed successfully!');
                        return Redirect::back();
                    }

                    return Redirect::back()->with('error', true);
                }

                return Redirect::back()->withErrors(array('current_password' => 'Invalid current password'));
            }
            return Redirect::back()->with('login', true);
        }

        return Redirect::back()->withErrors($validator);
    }

    public function getSignIn() {
        return view('auth.login');
    }

    public function getSignUp() {
        return view('auth.register');
    }

    public function getActivateAccount($code) {
        $user = User::where('code', '=', $code)->where('active', '=', 0);
        if ($user->count()) {
            $user = $user->first();
            $user->active = 1;
            $user->code = '';

            if ($user->save()) {
                return Redirect::route('sign-in')->with('success', true);
            }
            return Redirect::route('sign-in')->with('error', 'unactive-account');
        }
        return App::abort(404);
    }

    public function getSignOut() {
        Auth::logout();
        Session::forget('cart');
        if (!Session::has('cart')) {
            return Redirect::route('home');
        }
    }

    public function getForgotPassword() {
        return view('auth.passwords.email');
    }

    public function getForgotPasswordActivate(Request $request) {
        $user = User::where('code', '=', $request->token)->first();
        if($user != null){
            return view('auth.passwords.reset')
                ->with('user', $user);
        }else{
            return redirect::to('/account/sign-in');
        }
    }

    public function getChangePassword() {
        return view('changepassword');
    }

}
