@extends('layouts.master')

@section('title', 'Writer')

@section('content')

{{-- {{dd($orderDetails->order_detail_status_id)}} --}}

	<div class="row">
		<div class="col-sm my-auto text-center">
			<h1>{{ $orderDetails->subject }}</h1>
			<h6>{{ $orderDetails->product->classification->classification }} Under {{ $orderDetails->product->period->period }}</h6>
		</div>
		<div class="col-sm">
			<div class="card float-right" style="width: 21.5rem;">
			  <div class="card-body text-center">
			    <h5 class="card-title">Deadline</h5>
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

    <div class="col-md-8">
		<h3 class="my-3">Job Details</h3>
    	<div class="row">
    		<div class="col-sm">
				<ul class="list-group">
					<li class="list-group-item">Paper Type : {{ $orderDetails->type->type }} </li>
					<li class="list-group-item">Paper Format : {{ $orderDetails->format->format }}</li>
					<li class="list-group-item">No. of Sources : {{ $orderDetails->sources }}</li>
					<li class="list-group-item">Paper Language: {{ $orderDetails->language->language }}</li>
				</ul>
    		</div>
    		<div class="col-sm">
				<ul class="list-group">
					<li class="list-group-item">Paper Spacing : {{ $orderDetails->spacing->space }} </li>
					<li class="list-group-item">Client Name : {{ $orderDetails->order->user->name }}</li>
					<li class="list-group-item">Job Status : {{ $orderDetails->orderDetailStatus->status }}</li>
					<li class="list-group-item">Job Price : {{ $orderDetails->product->job_price * $orderDetails->pages }}</li>
				</ul>
    		</div>
    	</div>
    </div>

    <div class="col-md-4">
      <h3 class="my-3 text-center">Job Description</h3>
      <p>{{ str_limit($orderDetails->description, 270) }}</p>
      @if($orderDetails->orderDetailStatus->status == 'Pending')
        <a href="{{ route('writer.pick', ['id'=>$orderDetails->id]) }}" class="btn btn-primary">Pick</a>
      @elseif($orderDetails->orderDetailStatus->status == 'Processing')
        <a href="{{ route('writer.complete', ['id'=>$orderDetails->id]) }}" class="btn btn-success">Complete</a>
        <a href="{{ route('writer.deffer', ['id'=>$orderDetails->id]) }}" class="btn btn-outline-danger ">Defer</a>
      @endif
      <a href="{{ URL::previous() }}" class="btn btn-outline-secondary float-right">back</a>
    </div>

  </div>
  <!-- /.row -->

  <!-- Related Projects Row -->
  <h3 class="my-4">Related Documents</h3>

  <div class="row">

    <div class="col-md-3 col-sm-6 mb-4">
      <a href="#">
            <img class="img-fluid" src="http://placehold.it/500x300" alt="">
          </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
      <a href="#">
            <img class="img-fluid" src="http://placehold.it/500x300" alt="">
          </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
      <a href="#">
            <img class="img-fluid" src="http://placehold.it/500x300" alt="">
          </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
      <a href="#">
            <img class="img-fluid" src="http://placehold.it/500x300" alt="">
          </a>
    </div>

  </div>
  <!-- /.row -->

@endsection