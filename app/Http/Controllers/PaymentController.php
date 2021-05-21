<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use PayPal\Api\{Amount, Details, Item, ItemList, Payer, Payment, PaymentExecution, ExecutePayment, RedirectUrls, Transaction};
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\{Cart, Product, PaperClassification, PaperPeriod, PaperType, PaperSpacing, PaperLanguage, PaperFormat, Order, OrderDetail, Transactions, MpesaStk};
use Carbon\Carbon;
use Session;
use Illuminate\Foundation\Bootstrap\ConfigureLogging;

class PaymentController extends Controller
{
    private $_api_context;

    public function __construct()
    {
		/** PayPal api context **/
        $paypal_conf = \Config::get('paypal');

        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );

        $this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function paypal(Request $request)
    {
		$cart = Session::get('cart');

		// dd($cart);

		$payer = new Payer();
        $payer->setPaymentMethod('paypal');

		foreach($cart->items as $key => $product){

			// dd((int)$product['price'] * $product['pages']);

			$product_item = new Item();
			$product_item->setName($product['item']->classification->classification.' paper under '. $product['item']->period->period) /** item name **/
		           ->setCurrency('USD')
		           ->setQuantity($product['qty'])
		           ->setPrice((float)$product['price'] * $product['pages']); /** unit price **/

		    $all_products_arr[] = $product_item; /** all products list **/
		}

		$item_list = new ItemList();
        $item_list->setItems(array($product_item));

		$amount = new Amount();
        $amount->setCurrency('USD')
               ->setTotal((float)$cart->totalPrice);

		$transaction = new Transaction();
        $transaction->setAmount($amount)
            		->setItemList($item_list)
            		->setDescription('Your transaction description');

		$redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status')) /** Specify return URL **/
            		  ->setCancelUrl(URL::route('status'));

		$payment = new Payment();
        $payment->setIntent('Sale')
            	->setPayer($payer)
            	->setRedirectUrls($redirect_urls)
            	->setTransactions(array($transaction));

        /** dd($payment->create($this->_api_context));exit; **/

        try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				\Session::put('error', 'Connection timeout');
	            return Redirect::route('paywithpaypal');
			} else {
				\Session::put('error', 'Some error occur, sorry for inconvenient');
	            return Redirect::route('paywithpaypal');
			}
		}

		foreach ($payment->getLinks() as $link) {
			if ($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
	            break;
			}
		}

		/** add payment ID to session **/

	    Session::put('paypal_payment_id', $payment->getId());
		if (isset($redirect_url)) {
			/** redirect to paypal **/
	        return Redirect::away($redirect_url);
		}

		\Session::put('error', 'Unknown error occurred');
	    return Redirect::route('paywithpaypal');
	}

	public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

		/** clear the session payment ID **/
	    Session::forget('paypal_payment_id');

	    if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
			// return home with a fail message
        	return redirect()->route('home')->with(['error' => 'Payment Failed!']);
		}

		$payment = Payment::get($payment_id, $this->_api_context);

	    $execution = new PaymentExecution();
	    $execution->setPayerId(Input::get('PayerID'));

		/**Execute the payment **/
	    $result = $payment->execute($execution, $this->_api_context);

		if ($result->getState() == 'approved') {
			// dd($result);

			// Record into our DB
			$this->record();

			// record the transaction
	        $transactions = new Transactions();
	        $transactions->trans_id = uniqid();
	        $transactions->client_id = Auth::user()->id;
	        $transactions->amount = $result->transactions[0]->amount->total;
	        $transactions->type = $result->payer->payment_method . ' Deposit';
	        $transactions->currency = $result->transactions[0]->amount->currency;
	        $transactions->description = $result->transactions[0]->description;
	        $transactions->fee = '0';
	        $transactions->sender = $result->payer->payer_info->email;
	        $transactions->receiver = $result->transactions[0]->payee->email;
	        $transactions->status = $result->state;

	        $transactions->Save();

			// return home with a success message
	        return redirect()->route('home')->with(['success' => 'Thank you for entrusting us with your Job!']);
		}

		// return home with a fail message
        return redirect()->route('home')->with(['error' => 'Payment Failed!']);
	}

	public function record()
	{
		$cart = Session::get('cart');

        // dd($cart);
        // foreach($cart->items as $key => $product){
        //     dd(unserialize($product['details']));
        // }

        // Add into the order database
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->total_qty = $cart->totalQty;
        $order->total_price = $cart->totalPrice;
        $order->payment_status_id = 2;

        $order->save();

        foreach($cart->items as $key => $product){
            // The product details
            $productDetail = unserialize($product['details']);

            // Add into order details database
            $orderDetails = new OrderDetail;
            $orderDetails->uniqueId = uniqid();
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $product['item']['id'];
            $orderDetails->order_detail_status_id = 1;
            $orderDetails->quantity = $product['qty'];
            $orderDetails->pages = $product['pages'];
            $orderDetails->subject = $productDetail['topic'];
            $orderDetails->type_id = $productDetail['type'];
            $orderDetails->format_id = $productDetail['format'];
            $orderDetails->language_id = $productDetail['language'];
            $orderDetails->sources = $productDetail['source'];
            $orderDetails->spacing_id = $productDetail['space'];
            $orderDetails->description = $productDetail['details'];
            $orderDetails->files = $productDetail['file'];
            $orderDetails->deadline = $productDetail['deadline'];

            $orderDetails->save();
        }

        // Clear data session
        Session::forget('data');

        // Clear Cart session
        Session::forget('cart');
	}

	// --------------- Mpesa Implement ------------------- //

	/**
     * Lipa na M-PESA password
     * */
    public function lipaNaMpesaPassword()
    {
        $lipa_time = Carbon::parse(now())->format('YmdHms');
        $passkey = config('app.pass_key');
        $BusinessShortCode = intval(config('app.short_code'));
        $timestamp =$lipa_time;
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode.$passkey.$timestamp);
        return $lipa_na_mpesa_password;
    }

    /**
     * Generate access token
     */
    public function generateAccessToken()
    {
        $consumer_key=config('app.consumer_key');
        $consumer_secret=config('app.consumer_secret');
        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);

        return $access_token->access_token;
    }

    /**
     * Lipa na M-PESA STK Push method
     * */
    public function customerMpesaSTKPush(Request $request)
    {
    	$request->validate([
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        $amount = 1; //$request->get('amount');
        $description = $request->get('description');
        $phone_number = intval($request->get('phone_number'));

        $url = config('app.stk_push_url');
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => intval(config('app.short_code')),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::parse(now())->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $amount,
            'PartyA' => $phone_number, // replace this with your phone number
            'PartyB' => intval(config('app.short_code')),
            'PhoneNumber' => $phone_number, // replace this with your phone number
            'CallBackURL' => 'https://17707ed20950.ngrok.io/api/v1/hlab/stk/push/callback/',
            'AccountReference' => "Electwriting Co ltd",
            'TransactionDesc' => $description,
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);

        return redirect()->route('order.paymentMpesaConfirmation');
    }

    /**
     * J-son Response to M-pesa API feedback - Success or Failure
     */
    public function createValidationResponse($result_code, $result_description){
        $result=json_encode(["ResultCode"=>$result_code, "ResultDesc"=>$result_description]);
        $response = new Response();
        $response->headers->set("Content-Type","application/json; charset=utf-8");
        $response->setContent($result);
        return $response;
    }

    /**
     *  M-pesa Validation Method
     * Safaricom will only call your validation if you have requested by writing an official letter to them
     */
    public function mpesaValidation(Request $request)
    {
        $result_code = "0";
        $result_description = "Accepted validation request.";
        return $this->createValidationResponse($result_code, $result_description);
    }

    /**
     * M-pesa Transaction confirmation method, we save the transaction in our databases
     */
    public function mpesaConfirmation(Request $request)
    {
        $content=json_decode($request->getContent());
        $mpesa_transaction = new MpesaTransaction();
        $mpesa_transaction->TransactionType = $content->TransactionType;
        $mpesa_transaction->TransID = $content->TransID;
        $mpesa_transaction->TransTime = $content->TransTime;
        $mpesa_transaction->TransAmount = $content->TransAmount;
        $mpesa_transaction->BusinessShortCode = $content->BusinessShortCode;
        $mpesa_transaction->BillRefNumber = $content->BillRefNumber;
        $mpesa_transaction->InvoiceNumber = $content->InvoiceNumber;
        $mpesa_transaction->OrgAccountBalance = $content->OrgAccountBalance;
        $mpesa_transaction->ThirdPartyTransID = $content->ThirdPartyTransID;
        $mpesa_transaction->MSISDN = $content->MSISDN;
        $mpesa_transaction->FirstName = $content->FirstName;
        $mpesa_transaction->MiddleName = $content->MiddleName;
        $mpesa_transaction->LastName = $content->LastName;
        $mpesa_transaction->save();
        // Responding to the confirmation request
        $response = new Response();
        $response->headers->set("Content-Type","text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult"=>"Success"]));
        return $response;
    }

    // {"Body":{"stkCallback":{"MerchantRequestID":"7721-178282-1","CheckoutRequestID":"ws_CO_200520210903046521","ResultCode":1032,"ResultDesc":"Request cancelled by user"}}}

    /**
    * M-pesa stk push call back url
    */
    public function mpesaSTKCallBack(Request $request)
    {
      $content=json_decode($request->getContent(), true);
      $mpesa_stk = new MpesaStk();
      $body = $content['Body']['stkCallback'];
      $transaction = $body['CallbackMetadata']['Item'];
      $Amount = '';
      $MpesaReceiptNumber = '';
      $TransactionDate = '';
      $PhoneNumber = '';
      if ($body['CallbackMetadata']){
        $Amount = $transaction[0]['Value'];
        $MpesaReceiptNumber = $transaction[1]['Value'];
        $TransactionDate = $transaction[3]['Value'];
        $PhoneNumber = $transaction[4]['Value'];
      }
      $mpesa_stk->MerchantRequestID = $body['MerchantRequestID'];
      $mpesa_stk->CheckoutRequestID = $body['CheckoutRequestID'];
      $mpesa_stk->ResultCode = $body['ResultCode'];
      $mpesa_stk->ResultDesc = $body['ResultDesc'];
      $mpesa_stk->Amount = $Amount;
      $mpesa_stk->MpesaReceiptNumber = $MpesaReceiptNumber;
      $mpesa_stk->TransactionDate = $TransactionDate;
      $mpesa_stk->PhoneNumber = $PhoneNumber;
      $mpesa_stk->save();
    }


    /**
     * M-pesa Register Validation and Confirmation method
     *
     * NB: By default, Safaricom does not enable validation URL, you have to write an official letter for them to enable validation on your Shortcode.
     */
    public function mpesaRegisterUrls()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Bearer '. $this->generateAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'ShortCode' => "600141",
            'ResponseType' => 'Completed',
            'ConfirmationURL' => "https://blog.hlab.tech/api/v1/hlab/transaction/confirmation",
            'ValidationURL' => "https://blog.hlab.tech/api/v1/hlab/validation"
        )));
        $curl_response = curl_exec($curl);
        echo $curl_response;
    }
}
