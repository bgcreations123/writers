@extends('layouts.master')

@section('title', 'Profile')

@section('content')
	<div class="row">
		<div class="col-sm-3"><!--left col-->
	          
			<div class="text-center">
				<img src="{{ Voyager::image( $user->avatar ) }}" class="avatar img-circle img-thumbnail" alt="avatar">
			</div><br>
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="customFile">
				<label class="custom-file-label" for="customFile">Change Profile Pix</label>
			</div>
	        
    		<div class="card my-3">
				<div class="card-header">Website <i class="fa fa-link fa-1x"></i></div>
				<div class="card-body"><a href="#">http://your-site-name.com/</a></div>
			</div>
	      
			{{-- <ul class="list-group">
				<li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
			</ul>  --}}
	           
			<div class="card my-3">
				<div class="card-header">Social Media</div>
				<div class="card-body">
					<a href="#"><i class="fa fa-facebook fa-2x"></i></a>
          <a href="#"><i class="fa fa-github fa-2x"></i></a>
          <a href="#"><i class="fa fa-twitter fa-2x"></i></a>
          <a href="#"><i class="fa fa-pinterest fa-2x"></i></a>
          <a href="#"><i class="fa fa-google-plus fa-2x"></i></a>
				</div>
			</div>
	      
	    </div><!--/col-3-->

		<div class="col-sm-9">
		  <!-- Nav tabs -->
      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu1">Bio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu2">Edit</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <!-- Tab panes -->
          <div class="tab-content">
            <div id="home" class="container tab-pane active"><br>
              <h3>{{ $user->name }}</h3>
              <p>{{ $user->email }}</p>
            </div>
            <div id="menu1" class="container tab-pane fade"><br>
              <h3>Menu 1</h3>
              <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div id="menu2" class="container tab-pane fade"><br>
            	<h3 class="card-title">Menu 2</h3>
            	<hr>
              <form>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control form-control-sm" id="inputEmail4" placeholder="Email">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control form-control-sm" id="inputPassword4" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control form-control-sm" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                  <label for="inputAddress2">Address 2</label>
                  <input type="text" class="form-control form-control-sm" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control form-control-sm" id="inputCity" placeholder="Nairobi">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control form-control-sm">
                      <option selected>Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control form-control-sm" id="inputZip" placeholder="123">
                  </div>
                </div>
                <div class="form-group form-control-sm">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Check me out
                    </label>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
		</div><!--/col-9-->
	</div><!--/row-->
@endsection