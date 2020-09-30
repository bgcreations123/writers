@extends('layouts.writer_master')

@section('title', 'Inbox')

@section('content')

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
			<h1 class="h2">My Inbox</h1>
		</div>
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
	</main>
@endsection