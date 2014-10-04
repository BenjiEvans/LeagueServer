<?php
 require("../scripts/php/mysql_connect.php");
 $ign =  $mysqli->real_escape_string($_GET['ign']);
 $pass =  $mysqli->real_escape_string($_GET['auth']);
 $query = $mysqli->query("select UserID from Users where Ign='$ign' and Password='$pass'");
 if($query->num_rows == 1){
 
   if($mysqli->query("update Users set Activate = 1 where Ign='$ign'")){
      echo "Account has successfully been activated";
      
   }else echo "Sorry somthings not right... try again later";
   
     $mysqli->close(); 
 	 
 }
  else{
  	  echo "Incorrect parameters..";
  	  $mysqli->close();
  }
 
?>
