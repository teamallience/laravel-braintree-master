<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//home

Route::get('/', 'BlogController@showwelcome')->name('index');

/*show terms and policy page*/
Route::get('/terms', 'BlogController@showterms');

/*return redirect back*/
Route::get('/back', 'BlogController@back');


Route::get('/transaction/updateDB', 'TransactionController@updateDB');
// Route::get('url', 'KamalController@index')->name('url');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@dashboard')->name('client.dashboard');
    Route::get('/commission', 'HomeController@commission');

    Route::get('/stats-update', 'StatsController@getUpdates'); //for test route
    Route::get('/stats-get-balance', 'StatsController@getBalance'); //for test route
    Route::get('/chart-update', 'ChartController@getUpdate'); //for test route

    Route::get('/braintree/token', 'BraintreeTokenController@token');

    Route::get('/balance', 'BalanceController@index')->name('client.balance');
    Route::post('/balance/reg_card', 'BalanceController@reg_card');
    Route::post('/balance/reg_paypal_card', 'BalanceController@reg_paypal_card');
    Route::post('/balance/set_main', 'BalanceController@set_main');
    Route::post('/balance/autobill/set_limit', 'BalanceController@set_autobill_limit');
    Route::post('/balance/autobill/toggler', 'BalanceController@toggleAutobiller');

    Route::post('/balance/add_credit', 'BalanceController@post_add_credit')->name('client.add_credit');
    Route::post('/balance/add_credit_demo', 'BalanceController@post_add_credit_demo')->name('client.add_credit_demo');
    Route::post('/balance/add_credit_net', 'BalanceController@post_add_credit_net')->name('client.add_credit_net');

    Route::get('/balance/paymentmethod/{id}/remove', 'BalanceController@remove_payment_method');
    Route::get('/balance/paymentmethod/{id}/setmain', 'BalanceController@setmain');

    Route::get('/settings', 'SettingsController@index')->name('client.settings');
    Route::post('/change-password', 'AccountController@postChangePassword');


});




Route::group(array('before' => 'guest'), function() {

    // CSRF protection group

    Route::group(array('before' => 'csrf', 'prefix' => 'account'), function() {

        // Sign In post

        Route::post('/sign-in', array(
            'as' => 'sign-in-post',
            'uses' => 'AccountController@postSignIn'
                )
        );

        // Sign Up post

        Route::post('/sign-up', array(
            'as' => 'sign-up-post',
            'uses' => 'AccountController@postSignUp'
                )
        );

        // Forgot password post

        Route::post('/forgot-password', array(
            'as' => 'forgot-password-post',
            'uses' => 'AccountController@postForgotPassword'
                )
        );

        Route::post('/recover-password', 'AccountController@postRecoverPassword');


        // Sign In

        Route::get('/sign-in', array(
            'as' => 'sign-in',
            'uses' => 'AccountController@getSignIn'
                )
        );

        // Sign Up

        Route::get('/sign-up', array(
            'as' => 'sign-up',
            'uses' => 'AccountController@getSignUp'
                )
        );

        // Activate account

        Route::get('/activate/{code}', array(
            'as' => 'activate-account',
            'uses' => 'AccountController@getActivateAccount'
                )
        );

        // Forgot password

        Route::get('/forgot-password', array(
            'as' => 'forgot-password',
            'uses' => 'AccountController@getForgotPassword'
                )
        );

        // Activate temporary password

        Route::get('/recover-password', array(
            'as' => 'forgot-password-activate',
            'uses' => 'AccountController@getForgotPasswordActivate'
                )
        );
        // Sign Out

        Route::get('/sign-out', array(
            'as' => 'sign-out',
            'uses' => 'AccountController@getSignOut'
                )
        );
    });
});


Auth::routes();


Route::post('/pay/{product}', [
    'uses' => 'OrderController@postPayWithStripe',
    'as' => 'pay',
    'middleware' => 'auth'
]);





Route::prefix('admin')->group(function () {
  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
  Route::get('register', 'AdminController@create')->name('admin.register');
  Route::post('register', 'AdminController@store')->name('admin.register.store');
  Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
  Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
  Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');
 
    Route::get('/userlist', array(
        'as' => 'admin-userlist',
        'uses' => 'AdminController@getUserlist'
            )
    );
    Route::get('/delete/{id}', array(
        'as' => 'admin-user-delete',
        'uses' => 'AdminController@deleteUser'
            )
    );
    /* begin routes for products* */
    Route::get('/products', array(
        'as' => 'admin-products',
        'uses' => 'ProductController@getProducts'
            )
    );
    Route::get('/add/products', array(
        'as' => 'admin-add-products',
        'uses' => 'ProductController@addProducts'
            )
    );
    Route::post('/save/product', array(
        'as' => 'admin-product-save',
        'uses' => 'ProductController@saveProduct'
            )
    );
    Route::get('/product/delete/{id}', array(
        'as' => 'admin-product-delete',
        'uses' => 'ProductController@deleteProduct'
            )
    );
    Route::get('/product/edit/{id}', array(
        'as' => 'admin-product-edit',
        'uses' => 'ProductController@editProduct'
            )
    );
    Route::post('/product/update', array(
        'as' => 'admin-product-update',
        'uses' => 'ProductController@updateProduct'
            )
    );

});
