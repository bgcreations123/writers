@extends('layouts.writer_master')

@section('title', 'Inbox Messages')

@section('content')

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
			<h1 class="h2">Inbox Messages</h1>
		</div>

		<div class="tab-pane active" id="account" role="tabpanel">
			<div class="card shadow">
				<div class="card-header">
					<!-- <a class="btn btn-sm btn-outline-secondary float-right shadow">Gen. Actions</a> -->
					<button type="button" class="btn btn-success float-right shadow" data-toggle="modal" data-target="#composeModal">
					  	<i class="fa fa-edit"></i> 
					  	Compose
					</button>
				</div>
				<div class="card-body">
		            @if($inbox_messages->isEmpty())
		            	No messages found!
		            @else
			            <div class="tab-content">
				            <div id="primary" class="container tab-pane active">
				              	<ul class="list-group list-group-flush">
				              		<li class="list-group-item">
	                        			<div class="row">
		                        			<div class="col-md-1">
			                            		{{--  --}}
			                            	</div>

		                            		<div class="col-md-3">
			                            		<small>From</small>
			                            	</div>

			                            	<div class="col-md-7">
			                            		<small>Subject</small>
			                            	</div> 

											<div class="col-md-1">
												
			                            	</div>
			                            </div>
	                            	</li>
				              		@foreach($inbox_messages as $inbox)
		                        		<li class="list-group-item list-group-item-action">
		                        			<div class="row">
			                        			<div class="col-md-1">
				                            		<div class="checkbox">
				                                		<label>
				                                    		<input type="checkbox">
				                                		</label>
				                            		</div>
				                            	</div>

			                            		<div class="col-md-3 {{ ($inbox->messageStatus->status == 'unread') ? 'font-weight-bold' : '' }}">
				                            		<span class="fa fa-star-o"></span>

				                            		<a href="#"><span class="name" style="min-width: 120px; display: inline-block;">{{ $inbox->sender->name }}</span></a>
				                            	</div>

				                            	<div class="col-md-7">
				                            		<a href="{{ route('messages.show', ['id' => $inbox->id]) }}">
				                            			<span class="">{{ $inbox->subject }}</span>

				                            			<span class="text-muted" style="font-size: 11px;">
				                            			 	- {{ str_limit($inbox->message, 19) }}
				                            			</span> 
				                            		</a>

				                            		<span class="badge badge-light pull-right">
														{{ \Carbon\Carbon::parse($inbox->created_at)->diffForHumans() }}
				                            		</span>
				                            	</div> 

												<div class="col-md-1">
				                            		<span class="pull-right">
				                            			@if(!empty($inbox->attachment))
				                            				<a href="#">
				                            					<span class="fa fa-paperclip"></span>
				                            				</a>
				                            			@endif
				                            		</span>
				                            	</div>
				                            </div>
		                            	</li>
		                            @endforeach
	                    		</ul>
				            </div>
				        </div>
			        @endif
			    </div>
			    <div class="card-footer">
			    	<a href="#">Messages Footer</a>
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
							<select class="form-control" id="recipient" name="recipient">
								<option value="0">Choose</option>
								@foreach($users as $user)
									<option value="{{ $user->id }}">{{ $user->name }}</option>
								@endforeach
							</select>
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