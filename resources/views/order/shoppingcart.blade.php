@extends('layouts.master')

@section('title', "Shopping Cart")

@section('content')


{{-- {{ dd(Session::get('cart')) }} --}}

	@if(Session::has('cart'))

		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card mb-3">
				  	<div class="card-header bg-dark text-light">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						Shopping cart
						<a href="/home" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
					</div>
					<div class="card-body text-dark">
						<div class="row">
							<div class="col-md-12 col-lg-8">

								<div class="container mb-5"> {{-- Begin Table --}}
									<div class="row py-2 text-center align-items-center border border-primary text-primary">
										<div class="col-3">
											Product
										</div>
										<div class="col-sm">
											Qty
										</div>
										<div class="col-sm">
											Page Price
										</div>
										<div class="col-sm">
											Item Total
										</div>
										<div class="col-3">
											
										</div>
									</div>
									@foreach ($products as $product)
				    					<form action="{{ route('order.getUpdateItem', ['id'=>$product['item']['id']]) }}" method="post">
									 		{{ csrf_field() }}
											<div class="row py-2 text-center align-items-center border-bottom">
												<div class="col-3 text-left">
													<small>
														{{ $product['item']['classification']['classification'] }} 
														Under  
					 									{{ $product['item']['period']['period'] }}
						 								in 
						 								{{ $product['pages'] }} pages.
					 								</small>
												</div>
												<div class="col-sm">
													<input id="quantity" name="quantity" type="number" value ="{{ $product['qty'] }}" min="0" max="99" class="form-control form-control-sm">
												</div>
												<div class="col-sm">
													<small>
						 								$ {{ $product['price'] }}.00
						 							</small>
												</div>
												<div class="col-sm">
													<small>
						 								$ {{ $product['qty'] * $product['price'] * $product['pages'] }} .00
						 							</small>
												</div>
												<div class="col-3">
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
												</div>
											</div>
										</form>
									@endforeach
								</div> {{-- // End of table --}}

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
				                		<div class="col-md-6 col-sm-6 no-margin-left no-padding-left pull-left">
						                    <div class="row">
						                        <div class="col-6">
						                            <input name="coupon" type="text" class="form-control form-control-sm" placeholder="coupon code">
						                        </div>
						                        <div class="col-6">
						                            <input type="submit" class="btn btn-outline-secondary btn-sm" value="Use coupon">
						                        </div>
						                    </div>
						                </div>
				                    	<a href="#" class="btn btn-outline-secondary btn-sm pull-right">
				                        	Update shopping cart
				                    	</a>
				                	</div>
				                </div>
							</div>
							<div class="col-md-12 col-lg-4 text-center" style="border-top: 2px solid #5ea4f3; background-color: #f7fbff; height: 100%; padding: 10px;">
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
		</div>

	@else

		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card mb-3">
				  	<div class="card-header bg-dark text-light">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						Shopping cart
						<a href="/home" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
					</div>
					<div class="card-body text-dark">
						<h2 class="text-center">No Products in Your Cart</h2>
					</div>
				</div>
			</div>
		</div>

	@endif

@endsection