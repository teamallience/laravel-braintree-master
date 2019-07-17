<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use AuthorizeNetCIM;

use Braintree_Transaction;

use Mail;

use Pusher\Pusher;
use App\Mail\AutoPayEmail;
use App\User;
use App\Transaction;
use App\PaymentMethod;


class AutoPay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balance:autopay {--sleep=60}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add XX amount of credit when balance';

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
        while(true){
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
            // $pusher->trigger('client-dashboard', 'autopay2','pusher works ' . date('h:i:s'));
            $users = User::where('active', '=', 1)->whereNotNull('low_balance_limit')->whereNotNull('low_balance_worth')->where('autobill_toggler', '=', true)->get();
            foreach($users as $user){
                $balance = Transaction::where('user_id', '=', $user->id)->sum('credit');

                $amount = $user->low_balance_worth;

                if($balance < $user->low_balance_limit){
                    
                    $method  = PaymentMethod::where('user_id', '=', $user->id)->where('main', '=', 1)->first();
                    /* Create a merchantAuthenticationType object with authentication details
                   retrieved from the constants file */
                   if(isset($method->customer_id)){
                        if($method->type != 'paypal'){
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
                            $transactionRequestType->setAmount($amount);
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
                                        $transaction->user_id = $user->id;
                                        $transaction->customer_id = $method->customer_id;
                                        $transaction->amount = $amount;
                                        $transaction->credit = $amount * 97 / 100;
                                        $transaction->payment_method = $method->method . " Auto Bill";
                                        $transaction->save();

                                        Mail::to($user->email)->send(new AutoPayEmail($user, $transaction));

                                        $pusher->trigger('client-dashboard', 'autopay2', 'ok');
                                    }else{
                                        if($tresponse->getErrors() != null){
                                            // $request->session()->flash('status', 'danger');    
                                            $pusher->trigger('client-dashboard', 'autopay2', 'error0');
                                        }
                                    }
                                }else{
                                    $tresponse = $response->getTransactionResponse();
                                    if($tresponse != null && $tresponse->getErrors() != null){
                                        // $request->session()->flash('status', 'danger');
                                        $pusher->trigger('client-dashboard', 'autopay2', 'error1');
                                        // return redirect::back();
                                    }else{
                                        // $request->session()->flash('status', 'danger');
                                        $pusher->trigger('client-dashboard', 'autopay2', 'error2');
                                    }
                                }
                            }else{
                                // $request->session()->flash('status', 'danger');
                                $pusher->trigger('client-dashboard', 'autopay2', 'error3');
                                ;
                            }
                        }/*else{

                            $result = Braintree_Transaction::sale(
                                [
                                    'customerId' => $method->customer_id,
                                    'amount' => $amount,
                                ]);
                            if($result->success == true){
                                $transaction = new Transaction;
                                $transaction->user_id = $user->id;
                                $transaction->customer_id = $method->customer_id;
                                $transaction->amount = $amount;
                                $transaction->credit = $amount * 97 / 100;
                                $transaction->payment_method = $method->method . " Auto Bill";
                                $transaction->save();
                            }
                        }*/
                    }
                    
                        
                }
            }
            // sleep(intval($this->option('sleep')));
            usleep(20000000);
             // $pusher->trigger('client-dashboard', 'autopay2','pusher works ' . date('h:i:s'));
            $this->call('schedule:run');

        }
        
    }
}
