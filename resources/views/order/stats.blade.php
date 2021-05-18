@extends('layouts.master')

@section('title', "Order Stats")

@section('content')

	<div class="col-md-12">
        <div class="card">
        	<div class="card-header">
	            <ul class="nav nav-tabs nav-fill card-header-tabs">
	            	<li class="nav-item">
						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pending Jobs</a>
		            </li>
		            <li class="nav-item">
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Processing Jobs</a>
		            </li>
		            <li class="nav-item">
						<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Completed Jobs</a>
		            </li>
		        </ul>
            </div>
            <div class="card-body text-center">
	            <div class="tab-content" id="nav-tabContent">
	                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
	                    <table class="table" cellspacing="0">
	                        <thead>
	                            <tr>
	                                <th>Project ID</th>
	                                <th>Product</th>
	                                <th>Topic</th>
	                                <th>Deadline</th>
	                                <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	@if($pendingOrders->isEmpty())
	                        		<tr>
	                        			<td colspan="4">'No orders to show!'</td>
	                        		</tr>
	                        	@else
		                        	@foreach($pendingOrders as $pendingOrder)
			                            <tr>
			                                <td><a id="getDetails" href="" data-toggle="modal" data-target="#getDetailsModal" data-url="{{ route('order.jobDetails',['id'=>$pendingOrder->id])}}" title="preview job summery">{{ $pendingOrder->uniqueId }}</a></td>
			                                <td>
			                                	<small>
													{{ $pendingOrder['product']['classification']['classification'] }} 
													Paper Under  
				 									{{ $pendingOrder['product']['period']['period'] }}
					 								in 
					 								{{ $pendingOrder['pages'] }} pages.
				 								</small>
				 							</td>
				 							<td>
				 								{{ $pendingOrder->subject }}
				 							</td>
			                                <td>
			                                	<small>
			                                		{!! ($pendingOrder->deadline < \Carbon\Carbon::now()) ? '<span class="text-danger">Expired</span> '. \Carbon\Carbon::parse($pendingOrder->deadline)->diffForHumans() : \Carbon\Carbon::parse($pendingOrder->deadline)->toDayDateTimeString() .'<br>'. \Carbon\Carbon::parse($pendingOrder->deadline)->diffForHumans() !!}
			                                	</small>
			                                </td>
			                                <td>
			                                	<a href="{{ route('home.view_order', ['id'=>$pendingOrder->id]) }}" class="btn btn-outline-primary">View</a>
			                                </td>
			                            </tr>
			                        @endforeach
		                        @endif
	                        </tbody>
	                    </table>
	                </div>
	                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
	                    <table class="table" cellspacing="0">
	                        <thead>
	                            <tr>
	                                <th>Project ID</th>
	                                <th>Product</th>
	                                <th>Topic</th>
	                                <th>Deadline</th>
	                                <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            @if($processingOrders->isEmpty())
	                        		<tr>
	                        			<td colspan="4">'No processing orders to show!'</td>
	                        		</tr>
	                        	@else
		                        	@foreach($processingOrders as $processingOrder)
			                            <tr>
			                                <td><a id="getDetails" href="" data-toggle="modal" data-target="#getDetailsModal" data-url="{{ route('order.jobDetails',['id'=>$processingOrder->id])}}" title="preview job summery">{{ $processingOrder->uniqueId }}</a></td>
			                                <td>
												<small>
													{{ $processingOrder['product']['classification']['classification'] }} 
													Paper Under  
				 									{{ $processingOrder['product']['period']['period'] }}
					 								in 
					 								{{ $processingOrder['pages'] }} pages.
				 								</small>
			                                </td>
			                                <td>
				 								{{ $processingOrder->subject }}
				 							</td>
			                                <td>
			                                	<small>
			                                		{!! ($processingOrder->deadline < \Carbon\Carbon::now()) ? '<span class="text-danger">Expired</span> '. \Carbon\Carbon::parse($processingOrder->deadline)->diffForHumans() : \Carbon\Carbon::parse($processingOrder->deadline)->toDayDateTimeString() .'<br>'. \Carbon\Carbon::parse($processingOrder->deadline)->diffForHumans() !!}
			                                	</small>
			                                </td>
			                                <td><a href="{{ route('home.view_order', ['id'=>$processingOrder->id]) }}" class="btn btn-outline-primary">View</a></td>
			                            </tr>
			                        @endforeach
		                        @endif
	                        </tbody>
	                    </table>
	                </div>
	                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
	                    <table class="table" cellspacing="0">
	                        <thead>
	                            <tr>
	                                <th>Project ID</th>
	                                <th>Product</th>
	                                <th>Topic</th>
	                                <th>Time of Completion (GMT)</th>
	                                <th>Action</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            @if($completedOrders->isEmpty())
	                        		<tr>
	                        			<td colspan="4">'No completed orders to show!'</td>
	                        		</tr>
	                        	@else
		                        	@foreach($completedOrders as $completedOrder)
			                            <tr>
			                                <td><a id="getDetails" href="" data-toggle="modal" data-target="#getDetailsModal" data-url="{{ route('order.jobDetails', ['id' => $completedOrder->id])}}" title="preview job summery">{{ $completedOrder->uniqueId }}</a></td>
			                                <td>
			                                	<small>
													{{ $completedOrder['product']['classification']['classification'] }} 
													Paper Under  
				 									{{ $completedOrder['product']['period']['period'] }}
					 								in 
					 								{{ $completedOrder['pages'] }} pages.
					 								{{$completedOrder->id}}
				 								</small>
			                                </td>
			                                <td>
				 								{{ $completedOrder->subject }}
				 							</td>
			                                <td>
			                                	<small>
			                                		{{ \Carbon\Carbon::parse($completedOrder->updated_at)->toDayDateTimeString() }}
													<br />
													{{ \Carbon\Carbon::parse($completedOrder->updated_at)->diffForHumans() }}
			                                	</small>
			                                </td>
			                                <td>
			                                	<a href="{{ route('home.view_order', ['id' => $completedOrder->id]) }}" class="btn btn-outline-primary">View</a>
			                                </td>
			                            </tr>
			                        @endforeach
		                        @endif
	                        </tbody>
	                    </table>
	                </div>
	            </div>
            </div>
            <div class="card-footer">
            	<div class="text-right">
        			<a href="{{ route('home') }}" class="btn btn-light">Back</a>
        		</div>
            </div>
        </div>
    </div>

    <!-- Modal -->
	<div class="modal fade" id="getDetailsModal" tabindex="-1" role="dialog" aria-labelledby="getDetailsModalTitle" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" id="exampleModalLongTitle">Job Details</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
	      		<div class="modal-body">
	      			<div id="details"></div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      		</div>
	    	</div>
	  	</div>
	</div>

	{{-- script --}}
        <script>
            $(document).ready(function(){

                $(document).on('click', '#getDetails', function(e){

                    e.preventDefault();

                    var url = $(this).data('url');

                    $('#details').html(''); // leave it blank before ajax call
                    // $('#modal-loader').show();      // load ajax loader

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'JSON'
                    })
                    .done(function(data){
                        console.log(data);  
                        $('#details').html('');    
                        // $('#details').html(data.type); // load response
                        $('#details').html(data);
                        var $ul = $("<ul/>").attr('class', 'list-group');
                        $.each(data, function(index, item){
                           
                            // create an li element with the line details and append
                            // it to the ul
                            $ul.append( $("<li/>").attr('class', 'list-group-item').html(index + '<span class="pull-right">' + item + '</span>') );

                        });  
                        // create a new div, append the ul to it, and append the div to results
                        $('#details').append($ul);
                    })
                    .fail(function(){
                        $('#details').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                        // $('#modal-loader').hide();
                    });

                });

            });

        </script>

@endsection