<?php
//establishing database connection
$db = "csulalea_LeaugueServer";
$mysqli = new mysqli("localhost", "csulalea", "programming", $db);
if ($mysqli->connect_errno){
    header("HTTP/1.0 503 Service Unavailable");
    exit();
}       
?>
