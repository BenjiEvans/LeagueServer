<?php require("../templates/login_check.php") ?>
<?php

   if(isset($_GET['rq'])){
   	   
       $param = $_GET['rq'];
      
   	   if($param == 'logout')
   	   {
   	   
   	   	   unset($_SESSION["user"]);
   	   	   header("Location: /");
   	   	   exit();
   	   }
      
   
   }
  
?>
