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
						Mpesa Confirmation
					</div>
					<div class="card-body text-dark">
						<br>

						<hr>

						<div class="row justify-content-center">
							<aside class="col-sm-6">

								<article class="card">
									<div class="card-body p-5">
										<form role="form" method="POST" id="payment-form"  action="{{ route('stk-push') }}">
											{{ csrf_field() }}
											@if ($errors->any())
													<div class="alert alert-danger">
														<ul>
																@foreach ($errors->all() as $error)
																	<li>{{ $error }}</li>
																@endforeach
														</ul>
													</div><br />
												@endif
											<input type="hidden" name="amount" value="{{ Session::get('cart')->totalPrice }}" />
											<input type="hidden" name="description" value="Testing stk push on sandbox" />
											<div class="form-group">
												<label for="mpesa_code"> Enter your Mpesa Confirmation Code after making the payment </label>
												<input type="mpesa_code" name="mpesa_code" class="form-control" required />
												@if($errors->has('mpesa_code'))
														<div class="error">{{ $errors->first('mpesa_code') }}</div>
												@endif
											</div>
											<button class="btn btn-success btn-block" type="submit">
												<i class="fab fa-mpesa"></i>
												Confirm Payment
											</button>
										</form>

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
