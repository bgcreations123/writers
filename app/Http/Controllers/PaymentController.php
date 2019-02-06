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
use App\{Cart, Product, PaperClassification, PaperPeriod, PaperType, PaperSpacing, PaperLanguage, PaperFormat, Order, OrderDetail};
use Carbon\Carbon;
use Session;

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

			// Record into our DB
			$this->record();

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
}
