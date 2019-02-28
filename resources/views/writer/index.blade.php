@extends('layouts.master')

@section('title', 'Writer')

@section('content')

	<!-- Heading Row -->
    <div class="row my-4">
        <div class="col-lg-12 mx-auto">
			<ul class="nav nav-tab" id="myTab" role="tablist" aria-orientation="vertical">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#jobs" role="tab" aria-controls="jobs">Job Pool</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#picked" role="tab" aria-controls="picked">My Picked Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#deffer" role="tab" aria-controls="deffer">My Deffered Jobs</a>
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
								<div class="table-responsive-md">
									<table class="table table-hover">
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
												<td>{{ $job->product->classification->classification }} Paper <br />Under {{ $job->product->period->period }}</td>
												<td>{{ $job->subject }}</td>
												<td>$ {{ $job->product->job_price * $job->pages }}.00</td>
												<td>{{ \Carbon\Carbon::parse($job->deadline)->diffForHumans() }}</td>
												<td>
													<a class="btn btn-sm btn-outline-primary" href="{{ route('writer.view_job', ['id'=>$job->id]) }}">View Job</a>
												</td>
									    	</tr>
										@endforeach
									  </tbody>
									</table>
								</div>
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
								<div class="table-responsive-md">
									<table class="table table-hover">
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
									  	{{-- {{dd($job->product->classification->classification)}} --}}
									    	<tr>
												<th scope="row">{{ $job->orderDetail->uniqueId }}</th>
												<td>{{ $job->product['classification']['classification'] }} Paper <br />Under {{ $job->product['period']['period'] }}</td>
												<td>{{ $job->orderDetail->subject }}</td>
												<td>$ {{ $job->product['job_price'] * $job->orderDetail->pages }}.00</td>
												<td>{{ \Carbon\Carbon::parse($job->orderDetail->deadline)->diffForHumans() }}</td>
												<td>
													<a class="btn btn-sm btn-outline-primary" href="{{ route('writer.view_job', ['id'=>$job->orderDetail->id]) }}">View Job</a>
												</td>
									    	</tr>
										@endforeach
									  </tbody>
									</table>
								</div>
							@endif
							{{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
						</div>
					</div>
				</div>
				<div class="tab-pane" id="deffer" role="tabpanel">
					<div class="card">
						<div class="card-header">
							My Deffered Jobs
						</div>
						<div class="card-body">
							<h5 class="card-title">All Deffered Jobs</h5>
							@if($defferedJobs->isEmpty())
								<p>No deffered jobs!</p>
							@else
								<div class="table-responsive-md">
									<table class="table table-hover">
									  <thead>
									    <tr>
									      <th scope="col">Unique ID</th>
									      <th scope="col">Product</th>
									      <th scope="col">Topic</th>
									      <th scope="col">Penalty</th>
									      <th scope="col">Payment Status</th>
									      <th scope="col">Action</th>
									    </tr>
									  </thead>
									  <tbody>
									  	@foreach($defferedJobs as $job)
											<tr>
												<th scope="row">{{ $job->orderDetail->uniqueId }}</th>
												<td>{{ $job->product->classification->classification }} Paper <br />Under {{ $job->product->period->period }}</td>
												<td>{{ $job->orderDetail->subject }}</td>
												<td>$ {{ $job->product->penalty_price * $job->orderDetail->pages }}.00</td>
												<td>{{ $job->paymentStatus->status }}</td>
												<td>
													<a class="btn btn-sm btn-outline-primary" href="{{ route('writer.view_job', ['id'=>$job->orderDetail->id]) }}">View Job</a>
												</td>
											</tr>
									    @endforeach
									    <tr>
									    	<td colspan="3" class="text-right">Total:</td>
									    	<td class="align-center">$ {{ $TotalMoneyOwed }}.00</td>
									    	<td colspan="2"></td>
									    </tr>
									  </tbody>
									</table>
								</div>
							@endif
							{{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection