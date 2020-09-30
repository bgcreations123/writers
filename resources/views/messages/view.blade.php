@extends('layouts.writer_master')

@section('title', 'Sent Messages')

@section('content')

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
			<h1 class="h2">Read Message</h1>
		</div>
		<div class="container">

		    {{-- @include('messages.layout._header') --}}

	    	<div class="row">
				<div class="col-md-12 mx-auto">
					<div class="card shadow">
						<div class="card-header">
							<small><strong>Subject: </strong></small> {{ $message->subject }}
							<span class="pull-right">
								<a href="#" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#composeModal">Reply</a>
							</span>
						</div>
						<div class="card-body mx-1">
							<div class="mb-4">
								<small><strong>Message: </strong></small>
								<br />
								{{ $message->message }}
							</div>
							<small><strong>Attachements</strong></small>
							@if($message->files = true)
								<div class="row my-2 mx-1">
									@foreach($files as $file)
										<div class="card-deck">
						                    <div class="card p-2 shadow">
						                      <div class="card-block text-center">
						                        <h4 class="card-title text">
						                          <small>
						                            <a href="{{ url( 'download', ['ref', $file->name])  }}">Download</a>
						                          </small> 
						                        </h4>
						                        <p class="card-text">
						                          <small class="text-muted">
						                            <div>
						                              <a href="{{ url( 'download', ['job', $file->name])  }}">
						                                <span class="fa fa-file-o" style="font-size: 20px;"></span>
						                                <br>
						                                <small>{{ $file->name }}</small>
						                              </a>
						                            </div>
						                          </small>
						                        </p>
						                      </div>
						                    </div>
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
	                		<a class="btn btn-secondary btn-sm" href="{{ route('messages.inbox') }}">Back</a>
	                	</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Modal -->
	<div class="modal fade" id="composeModal" tabindex="-1" role="dialog" aria-labelledby="composeModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	    		<form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
	    			{{ csrf_field() }}
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="composeModalLabel">Modal title</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
		      		<div class="modal-body">
						<div class="form-group">
							<label for="recipient">Recipient</label>
                    		<input type="text" class="form-control" id="recipient" name="recipient" value="{{ ($message->reciever->id == Auth()->user()->id)?$message->sender->name:$message->reciever->name  }}" disabled>
						</div>
						<div class="form-group">
							<label for="subject" class="col-form-label">Subject:</label>
							<input type="text" class="form-control" id="subject" name="subject">
						</div>
						<div class="form-group">
							<label for="message-text" class="col-form-label">Message:</label>
							<textarea class="form-control" id="message-text" name="message"></textarea>
						</div>
						<div class="form-group">
							<label for="message-file" class="col-form-label">Attachment:</label>
							<input type="file" class="form-control" id="message-file" name="file[]" multiple>
						</div>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        		<button type="submit" class="btn btn-primary" name="send">Send Message</button>
		      		</div>
	      		</form>
	    	</div>
	  	</div>
	</div>

@endsection