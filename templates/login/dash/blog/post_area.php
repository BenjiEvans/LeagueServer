<?php

if(strcmp('Root',$_SESSION["user"]->status()) != 0){ //post restrictions doesn't apply to ROOT user 
     	$ign = $_SESSION["user"]->name();
     	$query = mysql_query("select Mute from Users where Ign='$ign'");
        $priv =mysql_fetch_assoc($query);
     	
        if($priv['Mute'] != 0 ) return;
        else printBlogPostArea();
        	
        
     	     
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

