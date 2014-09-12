<?php
//check to see if user has permission to post
if(strcmp('Root',$_SESSION["user"]->status()) != 0){ //post restrictions doesn't apply to ROOT user 
     	$ign = $_SESSION["user"]->name();
     	$query = $mysqli->query("select Mute from Users where Ign='$ign'");
        $priv = $query->fetch_assoc();
     	
        //if not mute post blog area
        if($priv['Mute'] != 0 ) printBlogPostArea();
        
         $query->close(); 	
     	     
} else printBlogPostArea();

function printBlogPostArea(){
	echo"
<div class='blogy' hidden>
          <form role='form'>
		  <div class='form-group'>
			<label for='login_email'><img src='../img/glyphicons_150_edit.png'>Post </label>
			<textarea id='user_post' class='form-control' rows='3' data-toggle='tooltip' title='this box is resizable (drag bottom-right corner)'> Got something to say?</textarea>
			<button id='post' type='button' class='btn btn-warning' style='float:left' data-toggle='modal' data-target='#post_modal'>Post</button>
		  </div>
             </form>
</div>";
}

?>

