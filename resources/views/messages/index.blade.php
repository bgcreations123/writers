@extends('layouts.master')

@section('title', 'Messages')

@section('content')
	<div class="container">

	    {{-- @include('messages.layout._header') --}}

    	<div class="row">

    		<div class="col-sm-3 col-md-2">
			    <!-- Button trigger modal -->
				<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#composeModal">
				  	<i class="fa fa-edit"></i> 
				  	Compose
				</button>
			    <hr>
				<ul class="nav nav-tab" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#inbox" role="tab" aria-controls="inbox">
							<span class="badge badge-pill badge-primary float-right">{{ ($unread > 0) ? $unread : '' }}</span> Inbox 
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#sent" role="tab" aria-controls="sent">
							Sent Mails
						</a>
					</li>
					{{-- <li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#drafts" role="tab" aria-controls="drafts">
							<span class="badge badge-pill badge-primary pull-right">3</span>Drafts
						</a>
					</li> --}}
				</ul>
			</div>

			<div class="col-sm-9 col-md-10">
				<div class="tab-content">
					<div class="tab-pane active" id="inbox" role="tabpanel">
						<div class="card">
		        			<div class="card-header">
								Inbox
							</div>
				            <div class="card-body">
					            <!-- Tab panes -->
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
						    </div>

						    <div class="card-footer">
						    	<a href="#">Messages Footer</a>
						    </div>
						</div>
					</div>
					<div class="tab-pane" id="sent" role="tabpanel">
						<div class="card">
							<div class="card-header">
								Outbox
							</div>
							<div class="card-body">
								<ul class="list-group list-group-flush">
									<li class="list-group-item">
	                        			<div class="row">
		                        			<div class="col-md-1">
			                            		
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
				              		@foreach($outbox_messages as $outbox)
		                        		<li class="list-group-item">
		                        			<div class="row">
			                        			<div class="col-md-1">
				                            		<div class="checkbox">
				                                		<label>
				                                    		<input type="checkbox">
				                                		</label>
				                            		</div>
				                            	</div>

			                            		<div class="col-md-3">
				                            		<a href="#">
				                            			<span class="name" style="min-width: 120px; display: inline-block;">
				                            				{{ $outbox->reciever->name }}
				                            			</span>
				                            		</a>
				                            	</div>

				                            	<div class="col-md-7">
				                            		<a href="{{ route('messages.show', ['id' => $outbox->id]) }}">
				                            			<span class="">{{ $outbox->subject }}</span>

				                            			<span class="text-muted" style="font-size: 11px;">
				                            			 	- {{ str_limit($outbox->message, 19) }}
				                            			</span> 
				                            		</a> 

				                            		<span class="badge badge-light pull-right">
														{{ \Carbon\Carbon::parse($outbox->created_at)->diffForHumans() }}
				                            		</span>
				                            	</div> 

												<div class="col-md-1">
				                            		<span class="pull-right">
				                            			@if(!empty($outbox->attachment))
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
							<div class="card-footer">
						    	<a href="#">Messages Footer</a>
						    </div>
						</div>
					</div>
					{{-- <div class="tab-pane" id="drafts" role="tabpanel">
						<div class="card">
							<div class="card-header">
								Unpaid Jobs
							</div>
							<div class="card-body">
								<h5 class="card-title">All Jobs Unpaid</h5>
								test
							</div>
						</div>
					</div> --}}
				</div>
			</div>
        </div>
	</div>

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