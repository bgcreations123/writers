@extends('layouts.writer_master')

@section('title', 'Complete')

@section('content')

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
			<h1 class="h2">Complete Job</h1>
		</div>

		{{-- {{dd($job)}} --}}
		<!-- Heading Row -->
	    <div class="row my-4">
	        <div class="col-lg-12 mx-auto">
				<div class="card shadow">
					<div class="card-header">
						<a class="btn btn-sm btn-outline-secondary float-right shadow">Gen. Actions</a>
					</div>
					<div class="card-body">
						<form action="{{ route('writer.completeJob', ['id'=>$job->order_detail_id]) }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="file-loading">
					        	<input id="file" name="file[]" type="file" class="file" data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..." multiple>
							</div>
					        <br>
					        <button type="submit" class="btn btn-primary">Submit</button>
					        <button type="reset" class="btn btn-outline-secondary">Reset</button>
					    </form>
					</div>
				</div>
	        </div>
	    </div>
	</main>
@endsection

<script type="text/javascript">
    $('#input-b3').fileinput({
        theme: 'fa',
    });
</script>