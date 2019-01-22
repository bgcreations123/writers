@extends('layouts.master')

@section('title', 'Writer Payments')

@section('content')
	<!-- Heading Row -->
      <div class="row my-4">
        <div class="col-lg-12 mx-auto">
			<ul class="nav nav-tab" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#account" role="tab" aria-controls="account">My Account</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#paid" role="tab" aria-controls="paid">Paid Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#unpaid" role="tab" aria-controls="unpaid">Unpaid Jobs</a>
				</li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="account" role="tabpanel">
					<div class="card">
						<div class="card-header">
							My Account
						</div>
						<div class="card-body">
							<h5 class="card-title">Transactions List</h5>
							<p>No transactions done yet!</p>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="paid" role="tabpanel">
					<div class="card">
						<div class="card-header">
							Paid Jobs
						</div>
						<div class="card-body">
							<h5 class="card-title">All Jobs paid</h5>
							@if($paidJobs->isEmpty())
								<p>Sorry, No jobs have been paid yet!</p>
							@else
								<table class="table">
								  <thead>
								    <tr>
								      <th scope="col">Unique ID</th>
								      <th scope="col">Product</th>
								      <th scope="col">Topic</th>
								      <th scope="col">Amount</th>
								      <th scope="col">Action</th>
								    </tr>
								  </thead>
								  <tbody>
								  	@foreach($paidJobs as $job)
										<tr>
											<th scope="row">{{ $job->orderDetail->uniqueId }}</th>
											<td>{{ $job->product->classification->classification }} Paper <br />Under {{ $job->product->period->period }}</td>
											<td>{{ $job->orderDetail->subject }}</td>
											<td>$ {{ $job->product->job_price }}.00</td>
											<td>
												<a class="btn btn-sm btn-outline-primary" href="{{ route('writer.view_job', ['id'=>$job->orderDetail->id]) }}">View Job</a>
											</td>
										</tr>
								    @endforeach
								  </tbody>
								</table>
							@endif
						</div>
					</div>
				</div>
				<div class="tab-pane" id="unpaid" role="tabpanel">
					<div class="card">
						<div class="card-header">
							Unpaid Jobs
						</div>
						<div class="card-body">
							<h5 class="card-title">All Jobs Unpaid</h5>
							@if($unPaidJobs->isEmpty())
								<p>Sorry, No jobs finished yet!</p>
							@else
								<table class="table">
								  <thead>
								    <tr>
								      <th scope="col">Unique ID</th>
								      <th scope="col">Product</th>
								      <th scope="col">Topic</th>
								      <th scope="col">Amount</th>
								      <th scope="col">Action</th>
								    </tr>
								  </thead>
								  <tbody>
								  	@foreach($unPaidJobs as $job)
										<tr>
											<th scope="row">{{ $job->orderDetail->uniqueId }}</th>
											<td>{{ $job->product->classification->classification }} Paper <br />Under {{ $job->product->period->period }}</td>
											<td>{{ $job->orderDetail->subject }}</td>
											<td>$ {{ $job->product->job_price }}.00</td>
											<td>
												<a class="btn btn-sm btn-outline-primary" href="{{ route('writer.view_job', ['id'=>$job->orderDetail->id]) }}">View Job</a>
											</td>
										</tr>
								    @endforeach
								  </tbody>
								</table>
							@endif
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection
