<?php
 require("../scripts/php/mysql_connect.php");
 $ign =  $mysqli->real_escape_string($_GET['ign']);
 $pass =  $mysqli->real_escape_string($_GET['auth']);
 $query = $mysqli->query("select id from Users where ign='$ign' and pass='$pass'");
 if($query->num_rows == 1){
 
   if($mysqli->query("update Users set active=1 where ign='$ign'")){
      echo "Account has successfully been activated.You can now log into your account";
      
   }else echo "Sorry somthings not right... try again later";
   
     $mysqli->close(); 
 	 
 }
  else{
  	  echo "Activation not valid..";
  	  $mysqli->close();
  }
 
?>
