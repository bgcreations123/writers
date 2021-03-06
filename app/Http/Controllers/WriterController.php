<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\{OrderDetail, Product, PickedJob, CompletedJob, CompletedJobsFiles, DefferedJob};

class WriterController extends Controller
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

    public function jobs(){
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

        return view('writer.jobs', compact('jobPool'));
    }

    public function my_jobs()
    {
        $my_jobs = PickedJob::where('writer_id', auth()->user()->id)->with('orderDetail')->whereHas('orderDetail', function ($query) {
            $query->where('deadline', '>=', Carbon::now());
        })
        ->whereNotNull('id')
        ->get();

        return view('writer.my_jobs', compact('my_jobs'));
    }

    public function deffered_jobs()
    {
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

        $deffered_jobs = DefferedJob::where('writer_id', auth()->user()->id)
        ->get();

        return view('writer.deffered_jobs', compact('deffered_jobs', 'TotalMoneyOwed'));
    }

    public function completed_jobs()
    {
        $completed_jobs = CompletedJob::where('writer_id', auth()->user()->id)->get();

        return view('writer.completed_jobs', compact('completed_jobs'));
    }

    public function pick($id)
    {
        $orderDetail = OrderDetail::find($id);
        
        if($orderDetail->order_detail_status_id != 1){
            return redirect()->route('home')->with(['error' => 'Sorry, the job has been taken.']);
        }

        $picked_jobs = PickedJob::where('writer_id', auth()->user()->id)->count();

        if($picked_jobs >= 3){
            return redirect()->back()->with(['error' => 'You can only pick upto 3 jobs.']);
        }

        //Find out if a user is picking own deffered job
        $myDefferedJob = DefferedJob::whereNotNull([['order_detail_id', $id], ['writer_id', Auth()->user()->id], ['payment_status_id', 1]]);

        if($myDefferedJob){
            // Delete from deffered job table
            DefferedJob::where([['order_detail_id', $id], ['writer_id', Auth()->user()->id], ['payment_status_id', 1]])->delete();
        }

        // Add into the picked jobs table
        $job = new PickedJob;
        $job->order_detail_id = $id;
        $job->writer_id = Auth::user()->id;
        $job->product_id = $orderDetail->product_id;

        $job->save();

        // Update order details status table
        OrderDetail::where('id', $id)->update(['order_detail_status_id' => 2]);

        return redirect()->route('home')->with(['success' => 'You have successfully picked a job.']);
    }

    public function deffer($id)
    {
        $orderDetail = OrderDetail::find($id);
        
        if($orderDetail->order_detail_status_id != 2){
            return redirect()->route('home')->with(['error' => 'Sorry, Use the right channel to pick jobs.']);
        }

        // Add into the deffered jobs table
        $job = new DefferedJob;
        $job->order_detail_id = $id;
        $job->writer_id = Auth::user()->id;
        $job->product_id = $orderDetail->product_id;
        $job->payment_status_id = 1;

        $job->save();

        // Update order details status table
        OrderDetail::where('id', $id)->update(['order_detail_status_id' => 1]);

        // Delete from picked job table
        PickedJob::where('order_detail_id', $id)->delete();

        return redirect()->route('home')->with(['error' => 'You have successfully Deffered a job. It comes with a penalty']);
    }

    public function complete($id)
    {
        $orderDetail = OrderDetail::find($id);

        if($orderDetail->order_detail_status_id != 2){
            return redirect()->route('home')->with(['error' => 'Sorry, Use the right channel to pick jobs.']);
        }

        $job = PickedJob::where('order_detail_id', $id)->first();

        return view('writer.complete', compact('job'));
    }

    public function completeJob(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'required',
        ]);

        // Identify job owner
        $job_owner = OrderDetail::with('order')->where('id', $id)->first();

        // dd(array_replace($request->input(), $fileName));

        // Identify Picked jobs
        $picked_job = PickedJob::where('order_detail_id', $id)->first();

        // dd($request->file('file'));

        // Add into the completed jobs table
        $job = new CompletedJob;
        $job->order_detail_id = $picked_job->order_detail_id;
        $job->writer_id = $picked_job->writer_id;
        $job->product_id = $picked_job->product_id;
        $job->payment_status_id = 1;
        $job->files = ($request->hasFile('file'))?'1':'0';
        $job->save();

        if($request->hasFile('file')) {
            
            $files = $request->file('file');

            // Perform uploads
            foreach($files as $file):
                $filename = time().$file->getClientOriginalName();
                // request()->file('files')->move(public_path('upload'), $request->file('files')->getClientOriginalName());
                // $uploadedFile = $request->file('file');
                // $filename = time().$uploadedFile->getClientOriginalName();
                Storage::disk('local')->putFileAs(
                    'files/'.$job_owner->order->user_id,
                    $file,
                    $filename
                );

                // Send files into the DB
                $file = new CompletedJobsFiles;
                $file->completed_job_id = $job->id;
                $file->name = $filename;
                $file->save();
            endforeach;
        }

        // request()->file('files')->move(public_path('upload'), $request->file('files')->getClientOriginalName());

        // Update order details status table
        OrderDetail::where('id', $picked_job->order_detail_id)->update(['order_detail_status_id' => 3]);

        // Delete from picked job table
        PickedJob::where('id', $picked_job->id)->delete();

        return redirect()->route('home')->with(['success' => 'You have successfully Completed your job.']);
    }

    public function viewJob($id)
    {
        $files = null;
        $completed = 0;
        $processing = 0;
        $orderDetails = OrderDetail::find($id);

        if($orderDetails->OrderDetailStatus->status == 'Processing'){
            $processing = PickedJob::where('order_detail_id', $orderDetails->id)->first();
        }elseif($orderDetails->orderDetailStatus->status == 'Complete'){
            $completed = CompletedJob::where('order_detail_id', $orderDetails->id)->first();

            // dd($completed);

            if($completed->files = true){
                $files = CompletedJobsFiles::where('completed_job_id', $completed->id)->get();
            }
        }

        // dd($completed);

        return view('writer.view_job', compact('orderDetails', 'processing', 'completed', 'files'));
    }

    public function my_account()
    {
        return view('writer.my_account');
    }

    public function payments()
    {
        $paidJobs = CompletedJob::where([['writer_id', auth()->user()->id], ['payment_status_id', 2]])->get();
    	
        return view('writer.payments', compact('paidJobs'));
    }

    public function unpaid()
    {
        $unPaidJobs = CompletedJob::where([['writer_id', auth()->user()->id], ['payment_status_id', 1]])->get();

        return view('writer.unpaid', compact('unPaidJobs'));
    }

}