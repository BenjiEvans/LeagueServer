<?php
//script is used to cache user information. Depends on mysqli connection and session start. create globals that can be accessed by all scripts
$ign =$_SESSION['user'];

$query = $mysqli->query("select status,team, id from Users where ign ='$ign'");
	$result = $query->fetch_assoc();
$team = $result['team'];
$status = $result['status'];
$id = $result['id'];
$query->close();


?>
