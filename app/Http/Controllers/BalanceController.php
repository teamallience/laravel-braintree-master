<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

use Validator;
use Redirect;
use Auth;

use AuthorizeNetCIM;

use Braintree_Customer;
use Braintree_Transaction;

use App\PaymentMethod;
use App\Transaction;
use App\User;

class BalanceController extends Controller
{
    //
    public function index(){
        
        $histories = Transaction::where('user_id', '=', Auth::id())->orderby('created_at','desc')->paginate(config('consts.CLIENT.HISTORY_PER_PAGE'));
        $total = Transaction::where('user_id', '=', Auth::id())->sum('credit');
        $page_info['menu'] = 'BALANCE';
        $page_info['submenu'] = 'ADD_METHOD';
        $balances = Transaction::where('user_id', '=', Auth::id())->get();
        $test_balance = 0.0;
        foreach($balances as $key => $value) {
            $test_balance += floatval($value->credit);
        }
        
        $last = Transaction::where('user_id', '=', Auth::id())->where('type', '=', 1)->orderby('created_at', 'desc')->first();
        if(isset($last->amount)){
            $last_deposit = $last->amount;
        }else{
            $last_deposit = 50;
        }
        
        $main = PaymentMethod::where('user_id','=',Auth::id())->where('main', '=', 1)->get();


        if(count($main) > 0 ){
            if($main->first()->type == 'paypal'){
                $user = User::find(Auth::id());
                Auth::user()->autobill_toggler = false;
                $user->autobill_toggler = false;
                $user->save();
            }
            $main_method = $main->first()->customer_id;
            $main_method_type = $main->first()->type;
        }else{
            $main_method = '';
            $main_method_type = '';
        }
        return view('pages.balance.index')
            ->with('histories', $histories)
            ->with('balance', $total)
            ->with('last_deposit', $last_deposit)
            ->with('main_method', $main_method)
            ->with('main_method_type', $main_method_type)
            ->with('page_info', $page_info);
    }
    

    public function reg_card(Request $request){
        
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('services.authorize.login'));
        $merchantAuthentication->setTransactionKey(config('services.authorize.key'));
        
        $refId = 'ref' . time();
        
        $validationmode = "liveMode";

        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($request->cc_number);

        $exp_month = strlen($request->cc_exp_month) == 1 ? '0'.$request->cc_exp_month: $request->cc_exp_month;

        $creditCard->setExpirationDate($request->cc_exp_year . '-'. $exp_month);
        $creditCard->setCardCode($request->cc_cvc);
        $paymentCreditCard = new AnetAPI\PaymentType();
        $paymentCreditCard->setCreditCard($creditCard);

        $paymentProfile = new AnetAPI\CustomerPaymentProfileType();
        $paymentProfile->setCustomerType('individual');
        $paymentProfile->setPayment($paymentCreditCard);
        $paymentProfile->setDefaultpaymentProfile(true);
        $paymentProfiles[] = $paymentProfile;
        
        // Create a new CustomerProfileType and add the payment profile object
        $customerProfile = new AnetAPI\CustomerProfileType();
        $customerProfile->setDescription("Test last haha");
        $customerProfile->setMerchantCustomerId("M_" . time());
        $customerProfile->setpaymentProfiles($paymentProfiles);
        $customerProfile->setEmail(Auth::user()->email);
        
        // Assemble the complete transaction request
        $request_customer = new AnetAPI\CreateCustomerProfileRequest();
        $request_customer->setMerchantAuthentication($merchantAuthentication);
        $request_customer->setRefId($refId);
        $request_customer->setProfile($customerProfile);
        if(config('services.authorize.env') == 'PRODUCTION'){
            $request_customer->setValidationMode($validationmode);    
        }
        

        // Create the controller and get the response
        $controller = new AnetController\CreateCustomerProfileController($request_customer);

        if(config('services.authorize.env') == 'SANDBOX'){
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
        }else{
            $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        }
      
        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {


            $paymentProfiles = $response->getCustomerPaymentProfileIdList();

            /*write down to db*/
            $method = new PaymentMethod;
            $method->user_id = Auth::id();
            $method->customer_id = $response->getCustomerProfileId();
            $method->payment_profile_id = $paymentProfiles[0];
            $method->method = '**** - ' . substr($request->cc_number, -4);
            $method->expireDate = $exp_month . '/' . $request->cc_exp_year;
            $method->type = $request->cc_type;
            $method->cc_name = $request->cc_name;
            $image = $request->cc_type == 'amex' ? 'american_express' : $request->cc_type;
            $method->image =  'https://assets.braintreegateway.com/payment_method_logo/' . $image .'.png?environment=production';
            count(Auth::user()->PaymentMethods) == 0 ? $method->main = 1 : $method->main = 0 ;
            $method->save();
            /*end write down to db*/
            $request->session()->flash('status', 'success');
            $request->session()->flash('description', 'You have added a new credit card successfully!');
  
            return redirect::back();
            
        } else {
            $errorMessages = $response->getMessages()->getMessage();
            $request->session()->flash('status', 'danger');
            $request->session()->flash('description', $errorMessages[0]->getText());
            return redirect::back();
        }
    }

    public function reg_paypal_card(Request $request){
        $result = Braintree_Customer::create([
            'paymentMethodNonce' => $request->payment_method_nonce
        ]);
        if ($result->success) {
            /*write down to db*/
            $method = new PaymentMethod;
            $method->user_id = Auth::id();
            $method->customer_id = $result->customer->id;
            $method->method = $result->customer->paymentMethods[0]->email;
            $method->image = $result->customer->paymentMethods[0]->imageUrl;
            $method->type = 'paypal';
            count(Auth::user()->PaymentMethods) == 0 ? $method->main = 1 : $method->main = 0;
            $method->save();
            $request->session()->flash('status', 'success');
            $request->session()->flash('description', 'You have successfully registered a paypal card');
        } else {
            // foreach($result->errors->deepAll() AS $error) {
            //     echo($error->code . ": " . $error->message . "\n");
            // }
            $request->session()->flash('status', 'danger');
            $request->session()->flash('description', 'Can not register your paypal card!');
        }
        return redirect::back();
    }

   
    public function remove_payment_method($id){
        $method = PaymentMethod::find($id);
        if($method){
            PaymentMethod::destroy($id);
        }
        if(count(Auth::user()->PaymentMethods) == 1){
            $main = Auth::user()->PaymentMethods->first();
            $main->main = 1;
            $main->save();
        }
        return redirect::back();
    }
    
    //add credit with authorize.net
    public function post_add_credit_net(Request $request){
        $rule = array(
            'amount'=> 'numeric|min:10|required',
            'customerId'=> 'required'
        );
        $messages = array(
            'customerId.required' => 'Please select payment method.',
            'amount.min' => 'The amount value must be at least $ :min.'
        );
        $validator = Validator::make($request->all(), $rule, $messages);
        if($validator->fails()){
            return redirect::back()->withErrors($validator);
        }

        $method  = PaymentMethod::where('user_id', '=', Auth::id())->where('main', '=', 1)->first();

        if($method->type != 'paypal'){
            /* Create a merchantAuthenticationType object with authentication details
           retrieved from the constants file */
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(config('services.authorize.login'));
            $merchantAuthentication->setTransactionKey(config('services.authorize.key'));
            
            $refId = 'ref' . time();
            $validationmode = "liveMode";
            
            $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
            $profileToCharge->setCustomerProfileId($method->customer_id);
            $paymentProfile = new AnetAPI\PaymentProfileType();
            $paymentProfile->setPaymentProfileId($method->payment_profile_id);
            $profileToCharge->setPaymentProfile($paymentProfile);
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
            $transactionRequestType->setAmount($request->amount);
            $transactionRequestType->setProfile($profileToCharge);
            $request_payone = new AnetAPI\CreateTransactionRequest();
            $request_payone->setMerchantAuthentication($merchantAuthentication);
            $request_payone->setRefId( $refId);
            // $request_payone->setValidationMode($validationmode);
            $request_payone->setTransactionRequest( $transactionRequestType);
            $controller = new AnetController\CreateTransactionController($request_payone);
            if(config('services.authorize.env') == 'SANDBOX'){
                $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
            }else{
                $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            }
            if ($response != null){
                if($response->getMessages()->getResultCode() == "Ok"){
                    $tresponse = $response->getTransactionResponse();
                    if ($tresponse != null && $tresponse->getMessages() != null){
                        $transaction = new Transaction;
                        $transaction->user_id = Auth::id();
                        $transaction->customer_id = $request->customerId;
                        $transaction->amount = $request->amount;
                        $transaction->credit = $request->amount * 97 / 100;
                        $transaction->payment_method = $method->method;
                        $transaction->save();
                        $request->session()->flash('status', 'success');
                        $request->session()->flash('description', 'You have added new credit successfully!');
                        return redirect::to('/balance'); 
                    }else{
                        if($tresponse->getErrors() != null){
                            $request->session()->flash('status', 'danger');
                            $request->session()->flash('description', $tresponse->getErrors()[0]->getErrorText());
                            return redirect::back();
                        }
                    }
                }else{
                    $tresponse = $response->getTransactionResponse();
                    if($tresponse != null && $tresponse->getErrors() != null){
                        $request->session()->flash('status', 'danger');
                        $request->session()->flash('description', $tresponse->getErrors()[0]->getErrorText());
                        return redirect::back();
                    }else{
                        $request->session()->flash('status', 'danger');
                        $request->session()->flash('description', $response->getMessages()->getMessage()[0]->getText());
                        return redirect::back();
                    }
                }
            }else{
                $request->session()->flash('status', 'danger');
                $request->session()->flash('description', $response->getMessages()->getMessage()[0]->getText());
                return redirect::back();
            }
        }else{
            $result = Braintree_Transaction::sale(
                [
                    'customerId' => $method->customer_id,
                    'amount' => $request->amount,
                    'options' => [
                        // 'storeInVaultOnSuccess' => true,
                        'submitForSettlement' => true
                    ]
                ]);
            if($result->success == true){
                $transaction = new Transaction;
                $transaction->user_id = Auth::id();
                $transaction->customer_id = $method->customer_id;
                $transaction->amount = $request->amount;
                $transaction->credit = $request->amount * 97 / 100;
                $transaction->payment_method = $method->method;
                $transaction->save();
                $request->session()->flash('status', 'success');
                $request->session()->flash('description', 'You have added new credit successfully!');
            }else{
                $request->session()->flash('status', 'danger');
                $request->session()->flash('description', 'You have faild in adding credit with paypal card');
            }
            return redirect::back();   
            
        }
    }
    public function set_autobill_limit(Request $request){
        $user = User::find(Auth::id());
        $user->low_balance_worth = $request->low_balance_worth;
        $user->low_balance_limit = $request->low_balance_limit;
        $user->save();
        return redirect::back();
    }

        //ajax get
    public function set_main(Request $request){
        $methods = PaymentMethod::where('user_id', '=', Auth::id())->get();
        foreach ($methods as $method) {
            $method->main = 0;
            $method->save();
        }
        $method = PaymentMethod::where('customer_id', '=', $request->main_method)->first();
        $method->main = 1;
        $method->save();
        $response = array(
            'status' => 'success',
        );
        return response()->json($response);
    }
    //http get
    public function setmain($id){
        $methods = PaymentMethod::where('user_id', '=', Auth::id())->get();
        foreach ($methods as $method) {
            $method->main = 0;
            $method->save();
        }
        $method = PaymentMethod::find($id);
        $method->main = 1;
        $method->save();
        return redirect::back();
    }

    public function toggleAutobiller(Request $request){
        $user = User::find(Auth::id());

        $user->autobill_toggler = $request->autobill_toggler == "true" ? true : false;
        if($user->save()){
            $response = array(
                'status' => 'success',
            );    
        }else{
            $response = array(
                'status' => 'failed',
            );
        }
        
        return response()->json($user);
    }
}
