<div id="post_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="login_modal_label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="login_modal_label">Commit Post</h4>
        </div>
        <div class="modal-body">
       
        Before you can commit this post please give it a title:
        <form role="form">
		  <div class="form-group">
			<label for="blog_title">Title</label>
			<input type="text" class="form-control" id="blog_title" placeholder="Enter Blog Title...">		
		  </div>
	</form>
	 <span id='blog_error'>hello<span>
        </div>
        <div class="modal-footer">
          <button id='commit' type="button" class="btn btn-warning" style='float:left' data-dismiss="modal" data-toggle="modal">Commit Post</button>
        </div>
      </div>
    </div>
  </div>
