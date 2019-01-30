@extends('layouts.master')

@section('title', 'Home - View')

@section('content')

{{-- {{dd($orderDetails->order_detail_status_id)}} --}}

	<div class="row">
		<div class="col-lg-8 col-md-12 my-auto text-center">
			<h1>{{ $orderDetails->subject }}</h1>
			<h6>{{ $orderDetails->product->classification->classification }} Under {{ $orderDetails->product->period->period }}</h6>
      <p>{{ $orderDetails->pages }} Pages</p>
		</div>
		<div class="col-lg-4 col-md-12">
			<div class="card">
			  <div class="card-body text-center">
			    <h5 class="card-title">Deadline</h5>
		        <p class="card-text">
              @if($orderDetails->orderDetailStatus->status == 'Complete')
                {{ \Carbon\Carbon::parse($orderDetails->updated_at)->toDayDateTimeString() }}
                <br />
                {{ \Carbon\Carbon::parse($orderDetails->updated_at)->diffForHumans() }}
              @else
                {!! ($orderDetails->deadline < \Carbon\Carbon::now()) ? 'Expired '. \Carbon\Carbon::parse($orderDetails->deadline)->diffForHumans() : \Carbon\Carbon::parse($orderDetails->deadline)->toDayDateTimeString() .'<br>'. \Carbon\Carbon::parse($orderDetails->deadline)->diffForHumans() !!}
              @endif
            </p>
			  </div>
			</div>
		</div>
	</div>


  <div class="row">

    <div class="col-lg-8 col-md-12">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="my-3">
          Job Details
        </h3>
        <span class="pr-2">
          <small>ID:</small> <strong>{{ $orderDetails->uniqueId }}</strong>
        </span>
      </div>
      
    	<div class="row">
    		<div class="col-md-6 my-2">
				<ul class="list-group">
					<li class="list-group-item">Paper Type : {{ $orderDetails->type->type }} </li>
					<li class="list-group-item">Paper Format : {{ $orderDetails->format->format }}</li>
					<li class="list-group-item">No. of Sources : {{ $orderDetails->sources }}</li>
					<li class="list-group-item">Paper Language: {{ $orderDetails->language->language }}</li>
				</ul>
    		</div>
    		<div class="col-md-6 my-2">
				<ul class="list-group">
					<li class="list-group-item">Paper Spacing : {{ $orderDetails->spacing->space }} </li>
					<li class="list-group-item">Client Name : {{ $orderDetails->order->user->name }}</li>
					<li class="list-group-item">Job Status : {{ $orderDetails->orderDetailStatus->status }}</li>
					<li class="list-group-item">Job Price : $ {{ $orderDetails->product->price * $orderDetails->pages }}.00</li>
				</ul>
    		</div>
    	</div>
    </div>

    <div class="col-lg-4 col-md-12">
      <h3 class="my-3 text-center">Job Description</h3>
      <p>{{ str_limit($orderDetails->description, 270) }}</p>
      <a href="{{ route('home') }}" class="btn btn-outline-secondary float-right">back</a>
    </div>

  </div> <!-- /.row -->

  <!-- Related Projects Row -->
  <h3 class="my-4">Related Documents</h3>

  <div class="row">

    <div class="col-md-3 col-sm-6 mb-4">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">File</h5>
          <p class="card-text">
            <small>name:</small> 
            {{ $orderDetails->files }}
          </p>
          <a class="btn btn-sm btn-primary mx-auto d-block" href="{{ url( 'download', [$orderDetails->files])  }}">Download</a>
        </div>
      </div>
    </div>

  </div> <!-- /.row -->

@endsection