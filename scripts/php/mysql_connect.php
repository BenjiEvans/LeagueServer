<?php
//establishing database connection
	$db = "leagueserver";
	
	$conn = mysql_connect("localhost","LeagueAdmin","password");
	
	if($conn) mysql_select_db($db,$conn);
        else{
        	// die('Unable to connect the database'.mysql_Error());
        	   header("503	Service Unavailable");
        }
       
?>
