@extends('layouts.master')

@section('title', 'Writer')

@section('content')

{{-- {{dd($job)}} --}}
	<!-- Heading Row -->
      <div class="row my-4">
        <div class="col-lg-12 mx-auto">
			<div class="card">
				<div class="card-header">
					Job Pool
				</div>
				<div class="card-body">
					<h5 class="card-title">Submit Your Job</h5>
					<form action="{{ route('writer.completeJob', ['id'=>$job->id]) }}" enctype="multipart/form-data" method="post">
						{{ csrf_field() }}
						<div class="file-loading">
				        	<input id="input-b3" name="input-b3[]" type="file" class="file" data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..." multiple>
						</div>
				        <br>
				        <button type="submit" class="btn btn-primary">Submit</button>
				        <button type="reset" class="btn btn-outline-secondary">Reset</button>
				    </form>
				</div>
			</div>
        </div>
    </div>
@endsection