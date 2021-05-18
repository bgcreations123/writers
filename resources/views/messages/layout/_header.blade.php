<div class="row">
	<div class="col-sm-3 col-md-2">
        <div class="dropdown">
		  	<button type="button" class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown">
		    	Mail 
		 	</button>
		  	<div class="dropdown-menu">
		    	<a class="dropdown-item" href="#">Mail</a>
		    	<a class="dropdown-item" href="#">Contacts</a>
		    	<a class="dropdown-item" href="#">Tasks</a>
		  	</div>
		</div>
    </div>
    <div class="col-sm-9 col-md-10">
        <!-- Split button -->
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
		  	<button type="button" class="btn btn-light btn-outline-secondary">
                <input type="checkbox" value="" id="defaultCheck1">
		  	</button>

		  	<div class="btn-group" role="group">
		    	<button id="chckBtn" type="button" class="btn btn-light btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
		    	<div class="dropdown-menu" aria-labelledby="chckBtn">
		      		<li><a class="dropdown-item" href="#">All</a></li>
                    <li><a class="dropdown-item" href="#">None</a></li>
                    <li><a class="dropdown-item" href="#">Read</a></li>
                    <li><a class="dropdown-item" href="#">Unread</a></li>
                    <li><a class="dropdown-item" href="#">Starred</a></li>
                    <li><a class="dropdown-item" href="#">Unstarred</a></li>
		    	</div>
		  	</div>
		</div>
        <button type="button" class="btn btn-light btn-outline-secondary" title="Refresh">
            <span class="fa fa-refresh"></span>
        </button>
        <!-- Single button -->
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
		  	<button type="button" class="btn btn-light btn-outline-secondary">
                More
		  	</button>

		  	<div class="btn-group" role="group">
		    	<button id="moreBtn" type="button" class="btn btn-light btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
		    	<div class="dropdown-menu" aria-labelledby="moreBtn">
	                    <li><a href="#">Mark all as read</a></li>
	                    <li class="divider"></li>
	                    <li class="text-center"><small class="text-muted">Select messages to see more actions</small></li>
	            </div>
			</div>
		</div>
        <div class="float-right">
            <span class="text-muted"><b>1</b>–<b>50</b> of <b>160</b></span>
            <div class="btn-group btn-group-sm">
                <button type="button" class="btn btn-light btn-outline-secondary">
                    <span class="fa fa-chevron-left"></span>
                </button>
                <button type="button" class="btn btn-light btn-outline-secondary">
                    <span class="fa fa-chevron-right"></span>
                </button>
            </div>
        </div>
    </div>
</div>
<hr>