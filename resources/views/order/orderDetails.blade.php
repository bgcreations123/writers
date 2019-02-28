@extends('layouts.master')

@section('title', 'New Project')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h1 class="text-center">Orders</h1>
				</div>
				<div class="card-body">
					<h5 class="card-title">New Order Info</h5>
					<div class="row">
						<div class="col-lg-4 col-md-12 col-sm-12">
							<ul class="list-group">
								<li class="list-group-item">Client Name: {{ $data['client'] }}</li>
								<li class="list-group-item">Paper Period: {{ $data['period'] }}</li>
								<li class="list-group-item">Paper Pages: {{ $data['pages'] }}</li>
								<li class="list-group-item">
									Price Per Page: $ {{ $data['product']['price'] }}
								</li>
								<li class="list-group-item">
									Total Price: $ {{ $data['product']['price'] * $data['pages'] }}.00
								</li>
							</ul>
						</div>
					</div>
					<hr>
					<h5 class="card-title">New Order Details Form</h5>
					<hr>
					<form action="{{ route('order.getAddToCart', [$data['product']['id']]) }}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<input type="hidden" name="pages" value="{{ $data['pages'] }}">
					  	<div class="form-group">
				    		<label for="inputTopic">Topic / Subject</label>
				    		<input type="text" class="form-control" id="topic" placeholder="Topic" name="topic" value="{{ old('topic') }}">
				  	  	</div>
					  	<div class="form-row">
						    <div class="form-group col-md-4">
						      	<label for="inputType">Paper Types</label>
						      	<select id="inputType" class="form-control" name="type">
						        	<option value="0" selected>Choose...</option>
						        	@foreach ($types as $type)
						        		<option value="{{ $type['id'] }}" {{ (old('type') == $type['id']) ? "selected" : "" }}>{{ $type['type'] }}</option>
						        	@endforeach
						      	</select>
						    </div>
						    <div class="form-group col-md-4">
						      	<label for="inputFormat">Paper format</label>
						      	<select id="inputFormat" class="form-control" name="format">
						        	<option value="0" selected>Choose...</option>
						        	@foreach ($formats as $format)
						        		<option value="{{ $format['id'] }}" {{ (old('format') == $format['id']) ? "selected" : "" }}>{{ $format['format'] }}</option>
						        	@endforeach
						      	</select>
						    </div>
						    <div class="form-group col-md-4">
						      	<label for="inputDeadline">
						      		GMT End Date/Deadline 
						      		<small>(According to Paper Period)</small>
						      	</label>
						      	<input type="text" id="deadline" name="deadline" class="form-control" value="{{ Carbon\Carbon::parse($data['period'])->toDateTimeString() }}" disabled="true">
						      	<input type="hidden" name="deadline" value="{{ Carbon\Carbon::parse($data['period'])->toDateTimeString() }}" />
						    </div>
					  	</div>
					  	<div class="form-row">	
					    	<div class="form-group col-md-4">
					      		<label for="inputSource">No. of Sources</label>
					      		<select id="inputSource" class="form-control" name="source">
					        		<option value="0" selected>Choose...</option>
					        		@for($i=1; $i<=20; $i++)
										<option value="{{$i}}"  {{ (old('source') == $i) ? "selected" : "" }}>{{$i}}</option>
									@endfor
					      		</select>
					    	</div>
					    	<div class="form-group col-md-4">
					      		<label for="inputSpacing">Paper Spacing</label>
						    	<select id="inputSpacing" class="form-control" name="space">
						      		<option value="0" selected>Choose...</option>
						      		@foreach ($spaces as $space)
						        		<option value="{{ $space['id'] }}"  {{ (old('space') == $space['id']) ? "selected" : "" }}>{{ $space['space'] }}</option>
						        	@endforeach
						    	</select>
					    	</div>
					    	<div class="form-group col-md-4">
					      		<label for="inputLanguage">Paper Language</label>
					      		<select id="inputLanguage" class="form-control" name="language">
					        		<option value="0" selected>Choose...</option>
					        		@foreach ($languages as $language)
						        		<option value="{{ $language['id'] }}"  {{ (old('language') == $language['id']) ? "selected" : "" }}>{{ $language['language'] }}</option>
						        	@endforeach
					      		</select>
					    	</div>
					  	</div>
					  	<div class="form-group">
					    	<label for="inputDetails">Paper Details</label>
					    	<textarea class="form-control" name="details" rows="7">{{ (old('details')) ? old('details') : "Paper details" }}</textarea>
					  	</div>
					  	<div class="form-group">
					  		<label for="files">Supporting Documents (Optional)</label>
						  	<div class="file-loading">
					        	<input id="files" name="files" type="file" class="file" data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..." multiple>
							</div>
					  	</div>
					  	<button type="submit" class="btn btn-primary">Submit</button>
					  	<a href="{{ route('home') }}" class="btn btn-danger btn-xs float-right">Cancel</a>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection