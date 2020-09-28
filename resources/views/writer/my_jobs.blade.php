@extends('layouts.writer_master')

@section('title', 'My Jobs')

@section('content')

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
			<h1 class="h2">My Pending Jobs</h1>
		</div>

		<div class="tab-pane" id="picked" role="tabpanel">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">All Pending jobs</h5>
					@if($my_jobs->isEmpty())
						<p>Great! No jobs pending.</p>
					@else
						<div class="table-responsive-md">
							<table class="table table-hover">
							  <thead>
							    <tr>
							      <th scope="col">Unique ID</th>
							      <th scope="col">Product</th>
							      <th scope="col">Topic</th>
							      <th scope="col">Wage Bill</th>
							      <th scope="col">Deadline</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							  	@foreach($my_jobs as $job)
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
	</main>

@endsection