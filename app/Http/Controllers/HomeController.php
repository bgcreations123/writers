<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\{User, PaperPeriod, PaperClassification, OrderDetail, PickedJob, CompletedJob, CompletedJobsFiles, DefferedJob, Product};
use Carbon\Carbon;
use Session;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::has('data') ? Session::forget('data') : null;

        $pendingOrders = OrderDetail::select('order_details.id', 'order_details.subject', 'order_details.deadline')
        ->where('order_details.order_detail_status_id', 1)
        ->leftJoin('orders', function ($query) {
            $query
            ->on('orders.id', '=', 'order_details.order_id')
            ->where('orders.user_id', auth()->user()->id);
        })
        ->whereNotNull('orders.id')
        ->orderBy('orders.id', 'desc')
        ->limit(3)
        ->get();

        // dd($pendingOrders);

        $processingOrders = OrderDetail::select('order_details.id', 'order_details.subject', 'order_details.deadline')
        ->where([['order_details.order_detail_status_id', 2], ['order_details.deadline', '>=', Carbon::now()]])
        ->leftJoin('orders', function ($query) {
            $query
            ->on('orders.id', '=', 'order_details.order_id')
            ->where('orders.user_id', '=', auth()->user()->id);
        })
        ->whereNotNull('orders.id')
        ->orderBy('orders.id', 'desc')
        ->limit(3)
        ->get();

        $completedOrders = OrderDetail::select('order_details.id', 'order_details.subject', 'order_details.updated_at')
        ->where('order_details.order_detail_status_id', 3)
        ->leftJoin('orders', function ($query) {
            $query
            ->on('orders.id', '=', 'order_details.order_id')
            ->where('orders.user_id', '=', auth()->user()->id);
        })
        ->whereNotNull('orders.id')
        ->orderBy('orders.id', 'desc')
        ->limit(3)
        ->get();

        // $jobPool = OrderDetail::select('id', 'uniqueId', 'product_id', 'subject', 'deadline')->where([['order_detail_status_id', 1], ['deadline', '>=', Carbon::now()]])->orderBy('created_at', 'desc')->get();

        $jobPool = OrderDetail::select('order_details.id', 'order_details.uniqueId', 'order_details.product_id', 'order_details.pages', 'order_details.subject', 'order_details.deadline')
        ->where([['order_detail_status_id', 1], ['deadline', '>=', Carbon::now()]])
        ->leftJoin('deffered_jobs', function ($query) {
                 $query
                 ->on('order_details.id', '=', 'deffered_jobs.order_detail_id')
                 ->where('deffered_jobs.writer_id', '=', auth()->user()->id);
             })
        ->whereNull('deffered_jobs.id')
        ->get();

        // $pickedJobs = PickedJob::where('writer_id', auth()->user()->id)
        // ->leftJoin('order_details', function ($query) {
        //     $query
        //     ->on('order_details.id', '=', 'picked_jobs.order_detail_id')
        //     ->where('deadline', '>=', Carbon::now());
        // })
        // ->whereNotNull('order_details.id')
        // ->get();

        $pickedJobs = PickedJob::where('writer_id', auth()->user()->id)->with('orderDetail')->whereHas('orderDetail', function ($query) {
            $query->where('deadline', '>=', Carbon::now());
        })
        ->whereNotNull('id')
        ->get();

        $defferedJobs = DefferedJob::where('writer_id', auth()->user()->id)
        ->get();

        $subTotalMoneyOwed = Product::leftJoin('deffered_jobs', function ($query) {
            $query
            ->on('products.id', '=', 'deffered_jobs.product_id')
            ->where('deffered_jobs.writer_id', '=', auth()->user()->id);
        })
        ->whereNotNull('deffered_jobs.id')
        ->sum('penalty_price');

        $subTotalPagesOwed = Product::leftJoin('deffered_jobs', function ($query) {
            $query
            ->on('products.id', '=', 'deffered_jobs.product_id')
            ->where('deffered_jobs.writer_id', '=', auth()->user()->id);
        })
        ->leftJoin('order_details', function ($query) {
            $query
            ->on('deffered_jobs.order_detail_id', '=', 'order_details.id');
        })
        ->whereNotNull('deffered_jobs.id')
        ->sum('pages');

        $TotalMoneyOwed = $subTotalMoneyOwed * $subTotalPagesOwed;
        
        $paperPeriods = PaperPeriod::all('period', 'id');
        $classifications = PaperClassification::all('classification', 'id');

        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('Editor')){
            return redirect('/admin');
        }elseif(auth()->user()->hasRole('Writer')){
            return view('writer.index', compact('jobPool', 'pickedJobs', 'defferedJobs', 'TotalMoneyOwed'));
        }else{
            return view('home.index', compact('paperPeriods', 'classifications', 'pendingOrders', 'processingOrders', 'completedOrders'));
        }

    }

    public function viewOrder($id)
    {
        $files = null;
        $completed = 0;
        $processing = 0;
        $orderDetails = OrderDetail::find($id);

        // If picked
        if($orderDetails->OrderDetailStatus->status == 'Processing'){
            $processing = PickedJob::where('order_detail_id', $orderDetails->id)->first();
        // If completed
        }elseif($orderDetails->orderDetailStatus->status == 'Complete'){
            $completed = CompletedJob::where('order_detail_id', $orderDetails->id)->first();

            // dd($completed);

            if($completed->files = true){
                $files = CompletedJobsFiles::where('completed_job_id', $completed->id)->get();
            }
        }

        return view('home.view_order', compact('orderDetails', 'completed', 'processing', 'files'));
    }

    public function profile($id)
    {
        $user = User::find($id);

        // check if user is true
        if($user->id != (int)auth()->user()->id){
            return redirect()->back()->with(['error'=> 'Stay in your place!']);
        }

        return view('user.profile', compact('user'));
    }
    
}
