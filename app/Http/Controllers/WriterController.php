<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\{OrderDetail, PickedJob, CompletedJob, DefferedJob};

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
        $defferedJob = DefferedJob::whereNotNull([['order_detail_id', $id], ['writer_id', Auth()->user()->id], ['payment_status_id', 1]]);

        if($defferedJob){
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

        $job = PickedJob::select('id')->where('order_detail_id', $id)->first();

        return view('writer.complete', compact('job'));
    }

    public function completeJob(Request $request, $id)
    {
        $picked_job = PickedJob::find($id);

        // Add into the completed jobs table
        $job = new CompletedJob;
        $job->order_detail_id = $picked_job->order_detail_id;
        $job->writer_id = $picked_job->writer_id;
        $job->product_id = $picked_job->product_id;
        $job->payment_status_id = 1;

        $job->save();

        // Update order details status table
        OrderDetail::where('id', $picked_job->order_detail_id)->update(['order_detail_status_id' => 3]);

        // Delete from picked job table
        PickedJob::where('id', $id)->delete();

        return redirect()->route('home')->with(['success' => 'You have successfully Completed your job.']);
    }

    public function payments()
    {
        $paidJobs = CompletedJob::where([['writer_id', auth()->user()->id], ['payment_status_id', 2]])->get();
    	$unPaidJobs = CompletedJob::where([['writer_id', auth()->user()->id], ['payment_status_id', 1]])->get();
        return view('writer.payments', compact('paidJobs', 'unPaidJobs'));
    }

    public function viewJob($id)
    {
        $orderDetails = OrderDetail::find($id);

        return view('writer.view_job', compact('orderDetails'));
    }

}