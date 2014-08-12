<?php

 session_start();
 //get the user's submitted json 
 $json = file_get_contents('php://input');
 $obj = json_decode($json);

//check feilds for emptyness 
 
print $obj->{'email'};
print $obj->{'pass'};

return;

// Create connection
//$con=mysqli_connect("localhost","LeagueAdmin","password","leagueserver");

// Check connection
/*if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  return;
}*/

// validate credentials 


?>
