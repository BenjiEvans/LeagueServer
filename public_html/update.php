<?php require("../scripts/php/login_check.php") ?>
<?php require("../scripts/php/json_functions.php")?>
<?php require("../scripts/php/mysql_connect.php")?>
<?php require("../scripts/php/user_info.php")?>
<?php require("../scripts/php/resource_functions.php"); ?>
<?php

  
   if(isset($_GET['total'])){

	 $total = $_GET['total'];
 	 $query = $mysqli->query("select * from Notes where recipient=$id");
    	if($query->num_rows != $total){ //just send all notes
      
		while($row = $query->fetch_assoc()) print_note($row['nid'],$row['sender'],$row['type']);

    	}else echo "";



    }

  
   if(isset($_GET['rq'])){

      if(is_null($team)) echo "";
      else print_team_profile($team);

   }



?>




<?php
function print_note($nid,$from,$type){
echo "<div id='$nid' class='real_note alert fade in ";

switch($type){

case 0://leave note
   echo "alert-warning'>";
   echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<h4><strong>Your Team is Gone!</strong></h4>";
   echo "<p>The captain of your team has left the team without assigning a new captain; as a result your team has been deleted.. </p>";
   echo "</div>";
break;

case 1:// request to join team
   $name = get_ign_by_id($from);
   echo "alert-info'>";
   echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<h4><strong>Join Request</strong></h4>";
   echo "<p><strong>$name</strong> wishes to join your team!</p>";
   echo "<p><button type='button' class='btn btn-success accept note_btn'>Accept request</button> <button type='button' class='btn btn-default decline note_btn'>Decline request</button></p>";
   echo "</div>";
break;

case 2:// join acccepted
       $team = get_team_by_captain($from);
       echo "alert-success'>";
       echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
       echo "<h4><strong>Join Request Accepted! </strong></h4>";
       echo "<p><strong>".$team."</strong> has accepted your request to join them!</p>";
       echo "<p><button type='button' class='btn btn-success accept note_btn'>Confirm join</button> <button type='button' class='btn btn-default decline note_btn'>Decline join</button></p>";
       echo "</div>";
break;

case 3:// join declined
     echo "alert-warning'>";
     echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
         $team = get_team_by_captain($from);
     echo "<strong>$team</strong> did not accept your request to join their team.</div>";
break;

case 4: //ban
   echo "alert-danger'>";
   echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<h4><strong>Banished!</strong></h4>";
   echo "You have been remove from your team.</div>";
break;

case 5: // new captain
   echo "alert-success'>";
   echo "<button type='button' class='close note_close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<h4><strong>Welcome captain!</strong></h4>";
   echo "You have been assigned as captain.</div>";
break;



}



}

function get_ign_by_id($id){

global $mysqli;
$query = $mysqli->query("select ign from Users where id=$id");
$row = $query->fetch_assoc();
$query->close();
return $row['ign'];

}

function get_team_by_captain($captain){

global $mysqli;

$query = $mysqli->query("select name from Teams where captain=$captain");
$row = $query->fetch_assoc();
$query->close();

return $row['name'];

}



?>
