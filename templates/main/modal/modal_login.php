<!-- Login Modal Start---->
  <div id="login_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="login_modal_label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="login_modal_label">Login</h4>
        </div>
        <div class="modal-body">
        <form role="form">
		  <div class="form-group">
			<label for="login_email">Ign </label>
			<input type="email" class="form-control" id="login_ign" placeholder="In game name">		
		  </div>
	  
		  <div class="form-group">
			<label for="login_pass">Password</label>
			<input type="password" class="form-control" id="login_pass" placeholder="Password">
		  </div>
		  <div class="checkbox" >
			<label>
			  <input type="checkbox"> Remember me
			</label>		
		  </div>
		  <!--<br>--><span id='login_error' style='color:rgb(250,0,0)'> </span>
	  
		</form>
        </div>
        <div class="modal-footer">
          <button id='reg' type="button" class="btn btn-warning" style='float:left' data-dismiss="modal" data-toggle="modal" data-target="#register_modal">Register</button>
          <button id='login' type="button" class="btn btn-primary">Login</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- login modalEnd --->

