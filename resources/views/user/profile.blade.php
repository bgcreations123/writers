@extends('layouts.master')

@section('title', 'profile')

@section('content')
	<div class="row">
		<div class="col-sm-3"><!--left col-->
	          
			<div class="text-center">
				<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
			</div><br>
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="customFile">
				<label class="custom-file-label" for="customFile">Change Profile Pix</label>
			</div>
	        
    		<div class="card my-3">
				<div class="card-header">Website <i class="fa fa-link fa-1x"></i></div>
				<div class="card-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
			</div>
	      
			<ul class="list-group">
				<li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
			</ul> 
	           
			<div class="card my-3">
				<div class="card-header">Social Media</div>
				<div class="card-body">
					<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
				</div>
			</div>
	      
	    </div><!--/col-3-->

		<div class="col-sm-9">
			<!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
      	<h3>Menu 2</h3>
      	<hr>
        <form class="form" action="##" method="post" id="registrationForm">
            <div class="form-group">
                  
                <div class="col-xs-6">
                    <label for="first_name"><h4>First name</h4></label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
                </div>
            </div>
            <div class="form-group">
                  
                <div class="col-xs-6">
                    <label for="last_name"><h4>Last name</h4></label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
                </div>
            </div>
  
            <div class="form-group">
                  
                <div class="col-xs-6">
                    <label for="phone"><h4>Phone</h4></label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                </div>
            </div>
  
            <div class="form-group">
                <div class="col-xs-6">
                   	<label for="mobile"><h4>Mobile</h4></label>
                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any.">
                </div>
            </div>
            <div class="form-group">
                  
                <div class="col-xs-6">
                    <label for="email"><h4>Email</h4></label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                </div>
            </div>
            <div class="form-group">
                  
                <div class="col-xs-6">
                    <label for="email"><h4>Location</h4></label>
                    <input type="email" class="form-control" id="location" placeholder="somewhere" title="enter a location">
                </div>
            </div>
            <div class="form-group">
                  
                <div class="col-xs-6">
                    <label for="password"><h4>Password</h4></label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                </div>
            </div>
            <div class="form-group">
                  
                <div class="col-xs-6">
                    <label for="password2"><h4>Verify</h4></label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <br>
                  	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                   	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                </div>
            </div>
      	</form>
      
      	<hr>
    </div>
  </div>

		</div><!--/col-9-->
	</div><!--/row-->
@endsection