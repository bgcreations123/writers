@extends('layouts.writer_master')

@section('title', 'My Account')

@section('content')

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
			<h1 class="h2">My Account</h1>
		</div>

		<div class="tab-pane active" id="account" role="tabpanel">
			<div class="card shadow">
				<div class="card-header">
					<a class="btn btn-sm btn-outline-secondary float-right shadow">Gen. Actions</a>
				</div>
				<div class="card-body">
					<p>No transactions done yet!</p>
				</div>
			</div>
		</div>

	</main>

@endsection