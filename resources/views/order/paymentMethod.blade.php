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
											<li class="nav-item">
												<a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
												<i class="fa fa-credit-card"></i> Credit Card</a></li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
												<i class="fab fa-paypal"></i>  Paypal</a></li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
												<i class="fa fa-university"></i>  Bank Transfer</a></li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane fade show active" id="nav-tab-card">
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
											</div> <!-- tab-pane.// -->

											<div class="tab-pane fade" id="nav-tab-paypal">
												
												<div id="paypal-button" class="text-center">
													<p>
														Paypal is easiest way to pay online
													</p>
												</div>
												<p>
													<strong>
														Note:
													</strong> 
													Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
												</p>
											</div>

											<script src="https://www.paypalobjects.com/api/checkout.js"></script>
											<script>
											  paypal.Button.render({
											    // Configure environment
											    env: 'sandbox',
											    client: {
											      sandbox: 'AXWgKUyaqNSAVWAii8otr33Qma32kog0lLK_dco4EQK9vJRKkOzGQvEwzXhQ3gERdQpjJqbnZtKmTD7g',
											      production: 'demo_production_client_id'
											    },
											    // Customize button (optional)
											    locale: 'en_US',
											    style: {
											      size: 'small',
											      color: 'gold',
											      shape: 'pill',
											    },

											    // Enable Pay Now checkout flow (optional)
											    commit: true,

											    // Set up a payment
											    payment: function(data, actions) {
											      return actions.payment.create({
											        transactions: [{
											          amount: {
											            total: '0.01',
											            currency: 'USD'
											          }
											        }]
											      });
											    },
											    // Execute the payment
											    onAuthorize: function(data, actions) {
											      return actions.payment.execute().then(function() {
											        // Show a confirmation message to the buyer
											        window.alert('Thank you for your purchase!');
											      });
											    }
											  }, '#paypal-button');

											</script>

											<div class="tab-pane fade" id="nav-tab-bank">
												<p>Bank accaunt details</p>
												<dl class="param">
												  	<dt>BANK: </dt>
												  	<dd> THE WORLD BANK</dd>
												</dl>
												<dl class="param">
												  	<dt>Account number: </dt>
												  	<dd> 12345678912345</dd>
												</dl>
												<dl class="param">
												  	<dt>IBAN: </dt>
												  	<dd> 123456789</dd>
												</dl>
												<p>
													<strong>
														Note:
													</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
													tempor incididunt ut labore et dolore magna aliqua. 
												</p>
											</div> <!-- tab-pane.// -->
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