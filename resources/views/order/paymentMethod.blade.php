@extends('layouts.master')

@section('title', "Payment Method")

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
						<br>
						<p class="text-center">
							payment section choose an option herein 
						</p>

						<hr>

						<div class="row justify-content-center">
							<aside class="col-sm-6">
								<p>Payment form</p>

								<article class="card">
									<div class="card-body p-5">

										<ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
											{{-- <li class="nav-item">
												<a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
												<i class="fa fa-credit-card"></i> Credit Card</a></li> --}}
											<li class="nav-item">
												<a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
												<i class="fab fa-paypal"></i>  Paypal</a></li>
											{{-- <li class="nav-item">
												<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
												<i class="fa fa-university"></i>  Bank Transfer</a></li> --}}
										</ul>

										<div class="tab-content">
											{{-- <div class="tab-pane fade show active" id="nav-tab-card">
												<p class="alert alert-success">Some text success or error</p>
												<form role="form">
													<div class="form-group">
														<label for="username">Full name (on the card)</label>
														<input type="text" class="form-control" name="username" placeholder="" required="">
													</div> <!-- form-group.// -->

													<div class="form-group">
														<label for="cardNumber">Card number</label>
														<div class="input-group">
															<input type="text" class="form-control" name="cardNumber" placeholder="">
															<div class="input-group-append">
																<span class="input-group-text text-muted">
																	<i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>   
																	<i class="fab fa-cc-mastercard"></i> 
																</span>
															</div>
														</div>
													</div> <!-- form-group.// -->

													<div class="row">
													    <div class="col-sm-8">
													        <div class="form-group">
													            <label><span class="hidden-xs">Expiration</span> </label>
													        	<div class="input-group">
													        		<input type="number" class="form-control" placeholder="MM" name="" max="12" min="0">
														            <input type="number" class="form-control" placeholder="YY" name="" min="2019" max="2025">
													        	</div>
													        </div>
													    </div>
													    <div class="col-sm-4">
													        <div class="form-group">
													            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
													            <input type="number" class="form-control" required="">
													        </div> <!-- form-group.// -->
													    </div>
													</div> <!-- row.// -->
													<button class="subscribe btn btn-primary btn-block" type="button"> Confirm  </button>
												</form>
											</div> --}} <!-- tab-pane.// -->

											<div class="tab-pane fade" id="nav-tab-paypal">
												<p>
													Paypal is easiest way to pay online
												</p>

												<form role="form" method="POST" id="payment-form"  action="{{ route('paypal') }}">
													{{ csrf_field() }}

													<button class="btn btn-primary btn-block" type="submit">
														<i class="fab fa-paypal"></i> 
														Proceed to Payment 
													</button>

												</form>

												<p>
													<strong>
														Note:
													</strong> 
													We accept CARD payments through paypal. 
												</p>
											</div>
											
											{{-- <div class="tab-pane fade" id="nav-tab-bank">
												{!! setting('bank.details') !!}
											</div> --}} <!-- tab-pane.// -->
										</div> <!-- tab-content .// -->

									</div> <!-- card-body.// -->
								</article> <!-- card.// -->

							</aside> <!-- col.// -->
						</div> <!-- row.// -->
					</div>
				</div>
			</div>

		</div> <!--row end.//-->
	@endif
@endsection