   <div id="team_create_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="login_modal_label">Create team</h4>
        </div>
        <div class="modal-body">
        <form role="form" id="team_form">
	  <div class="form-group">
	    <label for="team_name">Team name</label> <span id='team_create_error' class='control-label'> </span>
	    <input type="text" class="form-control" id="team_name" placeholder="Enter Team Name">
	  </div>
	  <button id='team_create_commit' type="submit" class="btn btn-default">Submit</button>
	</form>
	<div id='team_create_respon'>
	</div>
        </div>
      </div>
    </div>
  </div>
