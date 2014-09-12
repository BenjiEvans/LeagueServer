<!-- register modal start --->

<div id="register_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="register_modal_label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="register_modal_label">Register</h4>
        </div>
        <div class="modal-body">
        <form role="form" id='register_form'>
          <div class="form-group">
	    <label for="register_username">Username</label>
	    <input type="text" class="form-control reg" id="register_username" placeholder="In game name">
	  </div>
	  <div class="form-group">
	    <label class="control-label" for="register_email">Email address </label> 
	    <input type="email" class="form-control reg" id="register_email" placeholder="Please use CSULA email">
            <span id='email_error' class='control-label'></span>
	  </div>
          <div class="form-group">
	    <label class="control-label" for="register_cemail">Confirm Email </label>
	    <input type="email" class="form-control reg" id="register_cemail" placeholder="Confirm email">
	  </div>
	  <div class="form-group">
	    <label class="control-label" for="register_pass">Password</label>
	    <input type="password" class="form-control reg" id="register_pass" placeholder="Password">
	  </div>
           <div class="form-group">
	    <label class="control-label" for="register_cpass">Confirm Password</label>
	    <input type="password" class="form-control reg" id="register_cpass" placeholder="Password">
	  </div>
          <div class="checkbox">
	    <label>
	      <input id='termbox' type="checkbox"> <small>By clicking Sign Up, you agree to our <a id='terms'>Terms and Policy</a> of use</small>
	    </label>
	  </div>
           <div>
            <p id='conditions' class="bg-danger hidden"> Terms go here...</p>
           </div>
	</form>
	
	<!-- response from server -->
	<div id='register_response'hidden>
	</div>
	
        </div>
        <div class="modal-footer">
          <button id='register' type="button" class="btn btn-warning" style='float:left' disabled >Signup</button>
          <button id='ok' type='button' class="btn btn-warning" style='display:none;float:left'> Ok</button>
        </div>
       

      </div>
    </div>
  </div>

<!-- register modal end ----->
