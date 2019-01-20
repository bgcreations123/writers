@extends('layouts.master')

@section('title', 'Writer')

@section('content')

	<!-- Heading Row -->
    <div class="row my-4">
        <div class="col-lg-12 mx-auto">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#jobs" role="tab" aria-controls="jobs">Job Pool</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#picked" role="tab" aria-controls="picked">My Picked Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#complete" role="tab" aria-controls="complete">My Completed Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages">Messages</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-controls="settings">Settings</a>
				</li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="jobs" role="tabpanel">
					<div class="card">
						<div class="card-header">
							Job Pool
						</div>
						<div class="card-body">
							<h5 class="card-title">Pick A Job</h5>
							@if($jobPool->isEmpty())
							<p>Sorry, No jobs in the pool yet!</p>
							@else
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Unique ID</th>
							      <th scope="col">Product</th>
							      <th scope="col">Topic</th>
							      <th scope="col">Wadge Bill</th>
							      <th scope="col">Deadline</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
						    	@foreach($jobPool as $job)
							    	<tr>
										<th scope="row">{{ $job->uniqueId }}</th>
										<td>{{ $job->product->classification->classification }} Paper Under {{ $job->product->period->period }}</td>
										<td>{{ $job->subject }}</td>
										<td>$ {{ $job->product->job_price }}</td>
										<td>{{ \Carbon\Carbon::parse($job->deadline)->diffForHumans() }}</td>
										<td>
											<a href="{{ route('writer.view_job', ['id'=>$job->id]) }}">View Job</a>
										</td>
							    	</tr>
								@endforeach
							  </tbody>
							</table>
							@endif
							{{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
						</div>
					</div>
				</div>
				<div class="tab-pane" id="picked" role="tabpanel">
					<div class="card">
						<div class="card-header">
							My Picked Jobs
						</div>
						<div class="card-body">
							<h5 class="card-title">All Pending jobs</h5>
							@if($pickedJobs->isEmpty())
							<p>Sorry, No jobs Picked Yet!</p>
							@else
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Unique ID</th>
							      <th scope="col">Product</th>
							      <th scope="col">Topic</th>
							      <th scope="col">Wadge Bill</th>
							      <th scope="col">Deadline</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							  	@foreach($pickedJobs as $job)
							    	<tr>
										<th scope="row">{{ $job->orderDetail->uniqueId }}</th>
										<td>{{ $job->product->classification->classification }} Paper Under {{ $job->product->period->period }}</td>
										<td>{{ $job->orderDetail->subject }}</td>
										<td>$ {{ $job->product->job_price }}</td>
										<td>{{ \Carbon\Carbon::parse($job->orderDetail->deadline)->diffForHumans() }}</td>
										<td>
											<a href="{{ route('writer.view_job', ['id'=>$job->orderDetail->id]) }}">View Job</a>
										</td>
							    	</tr>
								@endforeach
							  </tbody>
							</table>
							@endif
							{{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
						</div>
					</div>
				</div>
				<div class="tab-pane" id="complete" role="tabpanel">
					<div class="card">
						<div class="card-header">
							My Completed Jobs
						</div>
						<div class="card-body">
							<h5 class="card-title">All Jobs Done</h5>
							@if($completedJobs->isEmpty())
							<p>Sorry, No jobs in the pool yet!</p>
							@else
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Unique ID</th>
							      <th scope="col">Product</th>
							      <th scope="col">Topic</th>
							      <th scope="col">Payment Status</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							  	@foreach($completedJobs as $job)
									<tr>
										<th scope="row">{{ $job->orderDetail->uniqueId }}</th>
										<td>{{ $job->product->classification->classification }} Paper Under {{ $job->product->period->period }}</td>
										<td>{{ $job->orderDetail->subject }}</td>
										<td>{{ $job->paymentStatus->status }}</td>
										<td>
											<a href="{{ route('writer.view_job', ['id'=>$job->orderDetail->id]) }}">View Job</a>
										</td>
									</tr>
							    @endforeach
							  </tbody>
							</table>
							@endif
							{{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
						</div>
					</div>
				</div>
				<div class="tab-pane" id="messages" role="tabpanel">
					<div class="card">
						<div class="card-header">
							My Messages
						</div>
						<div class="card-body">
							<h5 class="card-title">Inbox</h5>
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">First</th>
							      <th scope="col">Last</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <th scope="row">1</th>
							      <td>Mark</td>
							      <td>Otto</td>
							      <td>
							      	<a href="#">View</a> | 
							      	<a href="#">Edit</a> | 
							      	<a href="#">Delete</a>
							      </td>
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td>Jacob</td>
							      <td>Thornton</td>
							      <td>
							      	<a href="#">View</a> | 
							      	<a href="#">Edit</a> | 
							      	<a href="#">Delete</a>
							      </td>
							    </tr>
							    <tr>
							      <th scope="row">3</th>
							      <td>Larry</td>
							      <td>the Bird</td>
							      <td>
							      	<a href="#">View</a> | 
							      	<a href="#">Edit</a> | 
							      	<a href="#">Delete</a>
							      </td>
							    </tr>
							  </tbody>
							</table>
							{{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
						</div>
					</div>
				</div>
				<div class="tab-pane" id="settings" role="tabpanel">
					<div class="card">
						<div class="card-header">
							Settings
						</div>
						<div class="card-body">
							<h5 class="card-title">Special title treatment</h5>
							<p>This is supposed to contain any settings for jobs if any</p>
							<a href="#" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection