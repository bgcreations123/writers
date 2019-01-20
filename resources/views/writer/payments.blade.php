@extends('layouts.master')

@section('title', 'Writer Payments')

@section('content')
	<!-- Heading Row -->
      <div class="row my-4">
        <div class="col-lg-12 mx-auto">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#account" role="tab" aria-controls="account">My Account</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#paid" role="tab" aria-controls="paid">Paid Jobs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#unpaid" role="tab" aria-controls="unpaid">Unpaid Jobs</a>
				</li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="account" role="tabpanel">
					<div class="card">
						<div class="card-header">
							My Account
						</div>
						<div class="card-body">
							<h5 class="card-title">Preffered accounts heading</h5>
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">First</th>
							      <th scope="col">Last</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <th scope="row">1</th>
							      <td>Mark</td>
							      <td>Otto</td>
							      <td>
							      	<a href="#">View</a>
							      </td>
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td>Jacob</td>
							      <td>Thornton</td>
							      <td>
							      	<a href="#">View</a>
							      </td>
							    </tr>
							    <tr>
							      <th scope="row">3</th>
							      <td>Larry</td>
							      <td>the Bird</td>
							      <td>
							      	<a href="#">View</a>
							      </td>
							    </tr>
							  </tbody>
							</table>
							{{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
						</div>
					</div>
				</div>
				<div class="tab-pane" id="paid" role="tabpanel">
					<div class="card">
						<div class="card-header">
							Paid Jobs
						</div>
						<div class="card-body">
							<h5 class="card-title">Preffered accounts heading</h5>
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">First</th>
							      <th scope="col">Last</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <th scope="row">1</th>
							      <td>Mark</td>
							      <td>Otto</td>
							      <td>
							      	<a href="#">View</a>
							      </td>
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td>Jacob</td>
							      <td>Thornton</td>
							      <td>
							      	<a href="#">View</a>
							      </td>
							    </tr>
							    <tr>
							      <th scope="row">3</th>
							      <td>Larry</td>
							      <td>the Bird</td>
							      <td>
							      	<a href="#">View</a>
							      </td>
							    </tr>
							  </tbody>
							</table>
							{{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
						</div>
					</div>
				</div>
				<div class="tab-pane" id="unpaid" role="tabpanel">
					<div class="card">
						<div class="card-header">
							Unpaid Jobs
						</div>
						<div class="card-body">
							<h5 class="card-title">Preffered accounts heading</h5>
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">First</th>
							      <th scope="col">Last</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <th scope="row">1</th>
							      <td>Mark</td>
							      <td>Otto</td>
							      <td>
							      	<a href="#">View</a>
							      </td>
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td>Jacob</td>
							      <td>Thornton</td>
							      <td>
							      	<a href="#">View</a>
							      </td>
							    </tr>
							    <tr>
							      <th scope="row">3</th>
							      <td>Larry</td>
							      <td>the Bird</td>
							      <td>
							      	<a href="#">View</a>
							      </td>
							    </tr>
							  </tbody>
							</table>
							{{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection
