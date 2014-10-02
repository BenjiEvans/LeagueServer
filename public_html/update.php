<?php 
require("../models/user.php");
require("../scripts/php/login_check.php");
require("../scripts/php/mysql_connect.php");

// look for updates 
if(isset($_GET['rq'])){
  $param = $_GET['rq'];
  $respond = false;
  
  while ($respond == false){
  	 
  	  switch($param){
	  case 'note'://get any new notifications 
	   $id = $_GET['id'];
	   if(!is_numeric($id))	header("HTTP/1.0 406 Not Acceptable");
	   $query = $mysqli->query("select * from Notifications where UserID =(select UserID from Users where Ign='".$_SESSION['user']->name()."') and NoteID > $id and Respond=0");	 
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
			     echo "</div>";
			     $result->close();
		     break;
		     
		    case 'd':
			$note_id = $row['NoteID'];
			echo "<div id='$note_id' class='alert alert-warning fade in'>";
			echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
			$result = $mysqli->query("select TeamName from Teams where TeamID=(select TeamID from ResponseDispatcher where NoteID=$note_id)");
			$team = $result->fetch_assoc();
			echo "<strong>".$team['TeamName']."</strong> did not accept your request to join their team.</div>";
			$result->close();
			break;
			
		    case 'a':
		       $query =  $mysqli->query("select TeamName from Teams where TeamID=(select TeamID from ResponseDispatcher where NoteID=".$row['NoteID'].")");
		       $team = $query->fetch_assoc();
		       echo "<div id='".$row['NoteID']."' class='alert alert-success fade in'>";
		       echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		       echo "<h4><strong>Join Request Accepted! </strong></h4>";
		       echo "<p><strong>".$team['TeamName']."</strong> has accepted your request to join them!</p>";
		       echo "<p><button type='button' class='btn btn-success accept note_btn'>Confirm join</button> <button type='button' class='btn btn-default decline note_btn'>Decline join</button></p>";
		       echo "</div>";
		       $query->close();
			break;
			
			 case 'td':
		       echo "<div id='".$row['NoteID']."' class='alert alert-warning fade in'>";
		       echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
		       echo "<h4><strong>Your Team is Gone!</strong></h4>";
		       echo "<p>The captain of your team has left the team without assigning a new captain; as a result you team has been deleted.. </p>";
		       echo "</div>";
			    break;
			    
		    case 'b':  
			echo "<div id='".$row['NoteID']."' class='alert alert-danger fade in'>";
			echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
			echo "<h4><strong>Banished!</strong></h4>";
			echo "You have been remove from your team.</div>";
			    break;
			    
		    case 'c':
			$query = $mysqli->query("select TeamName from Teams where TeamID=".$_SESSION['user']->team."");
			$team = $query->fetch_assoc();
			echo "<div id='".$row['NoteID']."' class='alert alert-success fade in'>";
			echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
			echo "<h4><strong>Welcome captain!</strong></h4>";
			echo "You have been assigned a captain of <strong>".$team['TeamName']."</strong>.</div>";
			    break;
			
		     }
		     
		   
			   
	   }
		   $mysqli->close();
	   
	   
	   
	   header("HTTP/1.0 202 Accepted");	
		  exit();
		  break;
	  }
  	  
  	  
   } 
  
  
	
}

?>
