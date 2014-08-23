<?php
$db_conx = mysqli_connect("localhost", "username", "yourpassword", "database name");
// Evaluate the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
} 
?>
