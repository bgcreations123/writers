@extends('layouts.master')

@section('title', "Shopping Cart")

@section('content')

{{-- {{ dd(Session::get('cart')) }} --}}

	@if(Session::has('cart'))
		<section class="shopping-cart dark">
			<div class="container">
			    <div class="card shopping-cart">
		            <div class="card-header bg-dark text-light">
		                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
		                Shopping cart
		                <a href="/home" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
		                <div class="clearfix"></div>
		            </div>

		            <div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-8">
								<div class="items">
					 				<div class="product">
					 					<div class="row">
						 					<div class="col-md-12">
						 						<div class="info" style="padding: 0;">
								 					<div class="table-responsive">
														<table class="table">
															<thead class="thead-light">
																<tr>
																	<th scope="col">Product</th>
																	<th scope="col" style="text-align: center;">Qty</th>
																	<th scope="col" style="text-align: center;">Price Per Page</th>
																	<th scope="col" style="text-align: center;">Item Total Price</th>
																	<th scope="col" style="text-align: center;">Actions</th>
																</tr>
															</thead>
															<tbody>
																@foreach ($products as $product)
											    					<form action="{{ route('order.getUpdateItem', ['id'=>$product['item']['id']]) }}" method="post" enctype="multipart/form-data">
																 		{{ csrf_field() }}
																		<tr>
																			<td style="width: 30%">
																				{{ $product['item']['classification']['classification'] }} 
																				Under  
											 									{{ $product['item']['period']['period'] }}
												 								in 
												 								{{ $product['pages'] }} pages.		
																			</td>
																			<td>
																				<input id="quantity" name="quantity" type="number" value ="{{ $product['qty'] }}" min="0" max="99" class="form-control">
																			</td>
																			<td style="text-align: right;">
																				<div>
													 								$ {{ $product['price'] }}.00
													 							</div>
																			</td>
																			<td style="text-align: right;">
																				<span>
													 								$ {{ $product['price'] * $product['pages'] }} .00
													 							</span>
																			</td>
																			<td>
																				<div class="dropdown float-center">
																				  	<button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				  		<i class="fa fa-cog" aria-hidden="true"></i> 
																				    	Action
																				  	</button>
																				  	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																				    	<button class="dropdown-item" type="submit">Update</button>
																				    	<a class="dropdown-item" href="{{ route('reduceByOne', ['id'=>$product['item']['id']]) }}">Reduce By One</a>
																				    	<a class="dropdown-item" href="{{ route('removeItem', ['id'=>$product['item']['id']]) }}">Remove Item</a>
																				  	</div>
																				</div>
																			</td>
																		</tr>
																	</form>
			 													@endforeach
															</tbody>
														</table>
													</div>
								 				</div>
						 					</div>
						 				</div>
					 				</div>
					                <div class="row">
						                <div class="col-12 pull-right">
						                    <a href="{{ route('clearCart') }}" class="pull-right">
						                        Clear shopping cart
						                    </a>
						                </div>
						            </div>
					                <hr>
				 					<div class="row">
					                	<div class="col-12 pull-right">
					                		<div class="coupon col-md-5 col-sm-5 no-padding-left pull-left">
							                    <div class="row">
							                        <div class="col-6">
							                            <input name="cupone" type="text" class="form-control" placeholder="cupone code">
							                        </div>
							                        <div class="col-6">
							                            <input type="submit" class="btn btn-default" value="Use cupone">
							                        </div>
							                    </div>
							                </div>
					                    	<a href="#" class="btn btn-outline-secondary pull-right">
					                        	Update shopping cart
					                    	</a>
					                	</div>
					                </div>
					 			</div>
				 			</div>
			 			<div class="col-md-12 col-lg-4">
			 				<div class="summary">
			 					<h3>Summary</h3>
			 					<div class="summary-item"><span class="text">Item(s)</span><span class="price">{{ $total_qty }}</span></div>
			 					<div class="summary-item"><span class="text">Subtotal</span><span class="price">${{ $total_price }}</span></div>
			 					<div class="summary-item"><span class="text">Discount</span><span class="price">$ 0.00</span></div>
			 					<div class="summary-item"><span class="text">Total</span><span class="price">${{ $total_price }}</span></div>
			 					<a href="{{ route('order.getCheckout') }}" class="btn btn-primary btn-lg btn-block">Checkout</a>
				 			</div>
			 			</div>
					</div> 
				</div>
				<div class="card-footer text-right">
	                
	            </div>
	        </div>
		</section>
	@else
		<div class="card shopping-cart">
            <div class="card-header bg-dark text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Shopping cart
                <a href="/home" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
				<h2 class="text-center">No Products in Your Cart</h2>
			</div>
		</div>
	@endif

@endsection