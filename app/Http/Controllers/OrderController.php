<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\{Cart, Product, PaperClassification, PaperPeriod, PaperType, PaperSpacing, PaperLanguage, PaperFormat, Order, OrderDetail};
use Carbon\Carbon;
use Session;

class OrderController extends Controller
{
    public function newOrder(Request $request)
    {
        $this->validate($request, [
            'classification' => 'required|not_in:0',
            'period' => 'required|not_in:0',
            'pages' => 'required',
            'terms' => 'required',
        ]);

        $product = Product::where('classification_id', $request->input('classification'))->where('period_id', $request->input('period'))->first();

        $client = array('client'=>Auth::user()->name);

        $classification = PaperClassification::find($request->input('classification'));
        $period = PaperPeriod::find($request->input('period'));

        $classification = array('classification' => $classification['classification']);
        $period = array('period' => $period['period']);
        $product = array('product' => $product);

        $data = $request->input();
        $data = array_merge($data, $client);
        $data = array_replace($data, $classification, $period, $product);

        Session::put('data', $data);

        return redirect()->route('order.orderDetails')->with(['success'=> 'Your Order is successfully Started! Please Fill the Details.']);

    }

    public function orderDetails()
    {
        if(!Session::has('data')){
            return redirect()->route('home')->with(['error'=> 'Please Initialize Your Order!']);
        }

        $data = Session::get('data'); 

        $types = PaperType::all('type', 'id');
        $spaces = PaperSpacing::all('space', 'id');
        $languages = PaperLanguage::all('language', 'id');
        $formats = PaperFormat::all('format', 'id');

        return view('order.orderDetails', compact('data','types', 'spaces', 'languages', 'formats'));
    }

    public function getAddToCart(Request $request, $id)
    {
        // dd($request->input('files'));

        $this->validate($request, [
            'topic' => 'required',
            // 'type' => 'not_in:0',
            // 'format' => 'not_in:0',
            // 'source' => 'not_in:0',
            // 'space' => 'not_in:0',
            // 'language' => 'not_in:0',
            'details' => 'required|min:3|max:7000',
            // 'files' => 'required',
            'deadline' => 'required|after:today',
        ]);

        if ($request->hasFile('file')) {
            
            $files = $request->file('file');

            // Perform uploads
            foreach($files as $file):
                $filename = time().$file->getClientOriginalName();
                // request()->file('files')->move(public_path('upload'), $request->file('files')->getClientOriginalName());
                // $uploadedFile = $request->file('file');
                // $filename = time().$uploadedFile->getClientOriginalName();
                Storage::disk('local')->putFileAs(
                    'files/'.(int)auth()->user()->id,
                    $file,
                    $filename
                );

                // Send files into the DB
                $file = new OrderDetailsFiles;
                $file->order_details_id = $job->id;
                $file->name = $filename;
                $file->save();
            endforeach;
        }

        if ($request->hasFile('files')){
            
            $filename = time().$request->file('files')->getClientOriginalName();

            // request()->file('files')->move(public_path('upload'), $request->file('files')->getClientOriginalName());

            // Perform uploads
            $uploadedFile = $request->file('files');
            // $filename = time().$uploadedFile->getClientOriginalName();

            Storage::disk('local')->putFileAs(
                'files/'.(int)auth()->user()->id,
                $uploadedFile,
                $filename
            );
        }else{
            $filename = '';
        }
        
        $fileName = ['file' => $filename];
        
        // dd(array_replace($request->input(), $fileName));

        $pages = $request->pages;

        $product = Product::find($id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;

        $details = serialize(array_replace($request->input(), $fileName));

        $cart = new Cart($oldCart);
        $cart->add($product, $pages, $details, $product->id);

        $request->session()->put('cart', $cart);

        // dd($cart);

        return redirect()->route('shoppingCart');
    }

    public function getUpdateItem(Request $request, $id)
    {
        $product = Product::find($id);

        $quantity = $request->quantity;

        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;

        $cart = new Cart($oldCart);

        $cart->updateItem($quantity, $product->id);

        Session::put('cart', $cart);

        if (count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }

        return redirect()->route('shoppingCart')->with(['success'=> 'Your Cart has been updated Successfully!']);
    }

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        $cart->reduceByOne($id);

        if (count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }

        return redirect()->route('shoppingCart');
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($oldCart);

        $cart->removeItem($id);

        if (count($cart->items) > 0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }

        return redirect()->route('shoppingCart');
    }

    public function clearCart()
    {
        Session::forget('cart');

        return redirect()->route('shoppingCart');
    }

    public function getCart()
    {
        if(!Session::has('cart')){
            return view('order.shoppingcart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        // dd($cart);

        return view('order.shoppingcart', ['products' => $cart->items, 'total_price' => $cart->totalPrice, 'total_qty' => $cart->totalQty]);
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required|email',
            'msg'     => 'required'
        ]);

        return redirect()->route('home')->with(['success'=> 'Your message has been sent!']);
    }

    public function getStats()
    {
        // $pendingOrders = OrderDetail::select('*')
        // ->where('order_details.order_detail_status_id', 1)
        // ->leftJoin('orders', function ($query) {
        //     $query
        //     ->on('orders.id', '=', 'order_details.order_id')
        //     ->where('orders.user_id', auth()->user()->id);
        // })
        // ->whereNotNull('orders.id')
        // ->orderBy('orders.id', 'desc')
        // ->get();

        // $processingOrders = OrderDetail::select('*')
        // ->where([['order_details.order_detail_status_id', 2], ['order_details.deadline', '>=', Carbon::now()]])
        // ->leftJoin('orders', function ($query) {
        //     $query
        //     ->on('orders.id', '=', 'order_details.order_id')
        //     ->where('orders.user_id', '=', auth()->user()->id);
        // })
        // ->whereNotNull('orders.id')
        // ->orderBy('orders.id', 'desc')
        // ->get();

        // $completedOrders = OrderDetail::select('*')
        // ->where('order_details.order_detail_status_id', 3)
        // ->leftJoin('orders', function ($query) {
        //     $query
        //     ->on('orders.id', '=', 'order_details.order_id')
        //     ->where('orders.user_id', '=', auth()->user()->id);
        // })
        // ->whereNotNull('orders.id')
        // ->orderBy('orders.id', 'desc')
        // ->get();

        $pendingOrders = OrderDetail::with('order')->where(['order_detail_status_id' => 1])->orderBy('id', 'desc')->get();

        $processingOrders = OrderDetail::with('order')->where(['order_detail_status_id' => 2])->orderBy('id', 'desc')->get();

        $completedOrders = OrderDetail::with('order')->where(['order_detail_status_id' => 3])->orderBy('id', 'desc')->get();

        return view('order.stats', compact('pendingOrders', 'processingOrders', 'completedOrders'));
    }

    public function getJobDetails($id)
    {
        $detail = OrderDetail::where('order_id', $id)->first();

        return response()->json($detail);
    }

    public function getCheckout()
    {
        if(!Session::has('cart')){
            return redirect()->route('home')->with(['error'=> 'Sorry, Your Shopping Cart is Empty!']);
        }

        return redirect()->route('order.paymentMethod');

    }

    public function paymentMethod()
    {
        if(!Session::has('cart')){
            return redirect()->route('home')->with(['error'=> 'Sorry, Your Shopping Cart is Empty!']);
        }

        // dd(Session::get('cart')->items);

        return view('order.paymentMethod');
    }
}
