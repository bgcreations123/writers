@extends('layouts.master')

@section('title', "Shopping Cart")

@section('content')


{{-- {{ dd(Session::get('cart')) }} --}}

	@if(Session::has('cart'))

		<div class="row">
			<div class="card mb-3">
			  	<div class="card-header bg-dark text-light">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					Shopping cart
					<a href="/home" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
				</div>
				<div class="card-body text-dark">
					<div class="row">
						<div class="col-md-12 col-lg-8">
							<table class="table table-hover">
								<thead class="thead bg-primary text-light">
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
				    					<form action="{{ route('order.getUpdateItem', ['id'=>$product['item']['id']]) }}" method="post">
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
							<div class="row">
				                <div class="col-12 pull-right">
				                    <a href="{{ route('clearCart') }}" class="pull-right">
				                        Clear shopping cart
				                    </a>
				                </div>
				            </div>
				            <hr />
				            <div class="row">
			                	<div class="col-12 pull-right">
			                		<div class="col-md-5 col-sm-5 no-padding-left pull-left">
					                    <div class="row">
					                        <div class="col-6">
					                            <input name="cupone" type="text" class="form-control" placeholder="cupone code">
					                        </div>
					                        <div class="col-6">
					                            <input type="submit" class="btn btn-outline-secondary btn-default" value="Use cupone">
					                        </div>
					                    </div>
					                </div>
			                    	<a href="#" class="btn btn-outline-secondary btn-default pull-right">
			                        	Update shopping cart
			                    	</a>
			                	</div>
			                </div>
						</div>
						<div class="col-md-12 col-lg-4 text-center" style="border-top: 2px solid #5ea4f3; background-color: #f7fbff; height: 100%; padding: 30px;">
							<h4>Summery</h4>
							<ul class="list-group  list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info">
									Item(s) <span>{{ $total_qty }}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info">
									Subtotal <span>$ {{ $total_price }}.00</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info">
									Discount <span>$ 0.00</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center list-group-item-info">
									Total <span>$ {{ $total_price }}.00</span>
								</li>
								<a href="{{ route('order.getCheckout') }}" class="btn btn-primary btn-lg btn-block my-3">Checkout</a>
							</ul>
			 			</div>
					</div>
				</div>
			</div>
		</div>

	@else
		<div class="row">
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
		</div>
	@endif

@endsection