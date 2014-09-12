<?php
//establishing database connection
	$db = "LeagueServer";
	$mysqli = new mysqli("localhost", "LeagueAdmin", "password", $db);
	//$conn = mysql_connect("localhost","","password");
	
	if ($mysqli->connect_errno){
            header("503	Service Unavailable");
             exit();
        }
	       
?>
