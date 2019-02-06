@extends('layouts.master')

@section('title', 'Writer')

@section('content')

{{-- {{dd($orderDetails->order_detail_status_id)}} --}}

	<div class="row">
		<div class="col-lg-8 col-md-12 my-auto text-center">
			<h1>{{ $orderDetails->subject }}</h1>
			<h6>{{ $orderDetails->product->classification->classification }} Under {{ $orderDetails->product->period->period }}</h6>
      <p>{{ $orderDetails->pages }} pages</p>
		</div>
		<div class="col-lg-4 col-md-12">
			<div class="card">
			  <div class="card-body text-center">
			    @if($orderDetails->orderDetailStatus->status == 'Complete')
            <h5 class="card-title">Completed</h5>
          @else
            @if($orderDetails->deadline <= \Carbon\Carbon::now())
              <h5 class="card-title text-danger">Expired</h5>
            @else
              <h5 class="card-title">Deadline</h5>
            @endif
          @endif
          <p class="card-text">
            @if($orderDetails->orderDetailStatus->status == 'Complete')
              {{ \Carbon\Carbon::parse($orderDetails->updated_at)->toDayDateTimeString() }}
              <br />
              {{ \Carbon\Carbon::parse($orderDetails->updated_at)->diffForHumans() }}
            @else
              {{ \Carbon\Carbon::parse($orderDetails->deadline)->toDayDateTimeString() }}
              <br />
              {{ \Carbon\Carbon::parse($orderDetails->deadline)->diffForHumans() }}
            @endif
          </p>
			  </div>
			</div>
		</div>
	</div>


  <div class="row">

    <div class="col-lg-8 col-md-12">
		<h3 class="my-3">Job Details</h3>
    	<div class="row">
    		<div class="card">
          <div class="card-body">
    				<ul class="list-group">
    					<li class="list-group-item">Paper Type : {{ $orderDetails->type->type }} </li>
    					<li class="list-group-item">Paper Format : {{ $orderDetails->format->format }}</li>
    					<li class="list-group-item">No. of Sources : {{ $orderDetails->sources }}</li>
    					<li class="list-group-item">Paper Language: {{ $orderDetails->language->language }}</li>
    				</ul>
          </div>
    		</div>
    		<div class="card">
          <div class="card-body">
    				<ul class="list-group">
    					<li class="list-group-item">Paper Spacing : {{ $orderDetails->spacing->space }} </li>
    					<li class="list-group-item">Client Name : {{ $orderDetails->order->user->name }}</li>
    					<li class="list-group-item">Job Status : {{ $orderDetails->orderDetailStatus->status }}</li>
    					<li class="list-group-item">Job Price : $ {{ $orderDetails->product->job_price * $orderDetails->pages }}.00</li>
    				</ul>
          </div>
    		</div>
    	</div>
    </div>

    <div class="col-lg-4 col-md-12">
      <h3 class="my-3 text-center">Job Description</h3>
      <p>{{ str_limit($orderDetails->description, 270) }}</p>
      @if($orderDetails->orderDetailStatus->status == 'Pending')
        @if($orderDetails->deadline <= \Carbon\Carbon::now())
          <a class="btn btn-outline-secondary" href="#">Pay here</a>
        @else
          <a href="{{ route('writer.pick', ['id'=>$orderDetails->id]) }}" class="btn btn-primary">Pick</a>
        @endif
      @elseif($orderDetails->orderDetailStatus->status == 'Processing')
        <a href="{{ route('writer.complete', ['id'=>$orderDetails->id]) }}" class="btn btn-success">Complete</a>
        <a href="{{ route('writer.deffer', ['id'=>$orderDetails->id]) }}" class="btn btn-outline-danger ">Defer</a>
      @endif
      <a href="{{ URL::previous() }}" class="btn btn-outline-secondary float-right">back</a>
    </div>

  </div>
  <!-- /.row -->

  <div class="row">

    <div class="col-lg-6 col-md-3 col-sm-6 mb-4">

      <!-- Related Projects Row -->
      <h3 class="my-4">Related Documents</h3>
      
      <div class="card col-md-6">
        <div class="card-body">
          @if(empty($orderDetails->files))
            <p>No related files. Reffer to job description.</p>
          @else
            <h5 class="card-title">File</h5>
            <p class="card-text">
              <small>File name:</small>
              {{ $orderDetails->files }}
            </p>
            <a class="btn btn-sm btn-primary mx-auto d-block" href="{{ url( 'download', [$orderDetails->files])  }}">Download</a>
          @endif
        </div>
      </div>
    </div>

    @if($orderDetails->orderDetailStatus->status == 'Complete')
      <div class="col-lg-6 col-md-3 col-sm-6 mb-4">

        <!-- Finished Jobs Row -->
        <h3 class="my-4">Finished Documents</h3>

        <div class="card col-md-6">
          <div class="card-body">
            <h5 class="card-title">File</h5>
            @if(empty($completed->files))
              <p>Sorry, No Evidence/Proof of work!</p>
            @else
              <p class="card-text">
                <small>File name:</small> 
                {{ $completed->files }}
              </p>
              <a class="btn btn-sm btn-primary mx-auto d-block" href="{{ url( 'download', [$completed->files])  }}">
                Download
              </a>
            @endif
          </div>
        </div>
      </div>
    @endif

  </div>
  <!-- /.row -->

@endsection