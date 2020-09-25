@extends('layouts.master')

@section('title', 'View Message')

@section('content')
	<div class="container">

	    {{-- @include('messages.layout._header') --}}

    	<div class="row">
			<div class="col-md-10 mx-auto">
				<div class="card">
					<div class="card-header">
						<small><strong>Subject: </strong></small>
						<br />
						{{ $message->subject }}
						<span class="pull-right">
							<a class="btn btn-secondary btn-sm" href="{{ route('messages') }}">Back To Messages</a>
						</span>
					</div>
					<div class="card-body">
						<div>
							<small><strong>Message: </strong></small>
							<br />
							{{ $message->message }}
						</div>
						<small><strong>Attachements</strong></small>
						@if($message->files = true)
							<div class="row">
								@foreach($files as $file)
									<div class="col-md-2">
										<a href="#">
											<span class="fa fa-file-o" style="font-size: 60px;"></span>
											<br>
											{{ $file->name }}
										</a>
									</div>
								@endforeach
							</div>
						@endif
						<div class="my-4">
							<small><strong>From: </strong></small>
							<br />
							{{ ($message->sender_id == Auth()->user()->id) ? 'Me' : $message->sender->name }}
						</div>
					</div>
					<div class="card-footer text-right">
                		{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
                	</div>
				</div>
			</div>
		</div>
	</div>

@endsection