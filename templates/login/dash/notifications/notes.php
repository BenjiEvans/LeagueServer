  <!--note 1 
		  <div class="alert alert-warning fade in">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
		  </div>
	          <!-- note 2
		  <div class="alert alert-danger fade in">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    <h4>Oh snap! You got an error!</h4>
		    <p>Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p>
		    <p>
		      <button type="button" class="btn btn-danger">Take this action</button>
		      <button type="button" class="btn btn-default">Or do this</button>
		    </p>
		  </div> -->
<?php
//get all notifications and package them in divs for presentation 

   $query = $mysqli->query("select * from Notifications where UserID =(select UserID from Users where Ign='".$_SESSION['user']->name()."') and Respond=0");
   if($query->num_rows == 0)echo "<h2> No Notifications...</h2>";
   else{
   	 echo  "<div class='page-header'>
		    <h1>Notifications<!-- <small>Bootstrap Visual Test</small>--></h1>
		  </div>";  
   }
   while($row = $query->fetch_assoc())
   {
     switch($row['NoteType']){
     case 'tr':
     	     $result = $mysqli->query("select Ign from Users where UserID=(select UserID from RequestDispatcher where NoteID=".$row['NoteID'].")");
     	     $array = $result->fetch_assoc();
     	     $name = $array['Ign'];
     	     echo "<div id='".$row['NoteID']."' class='alert alert-info fade in'>";
     	     echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
     	     echo "<h4><strong>Join Request</strong></h4>";
     	     echo "<p><strong>$name</strong> wishes to join your team! Feel free you view his profile <a href='#'>HERE</a></p>";
     	     echo "<p><button type='button' class='btn btn-success accept note_btn'>Accept request</button> <button type='button' class='btn btn-default decline note_btn'>Decline request</button></p>";
     	     echo "<div>";
     	     $result->close();
     break;
     
    case 'td':
	
    	echo "<div id='".$row['NoteID']."' class='alert alert-warning fade in'>";
        echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
        echo "<strong>Holy guacamole!</strong> did not accept your request to join check yo self, you're not looking too good.</div>";
	break;
     	     
     }
    	   
   }
   $mysqli->close();


?>
