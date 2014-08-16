<?php require("../templates/mysql_connect.php") ?>
<?php
  


//get the user's submitted json 
 $json = file_get_contents('php://input');
 $obj = json_decode($json);


 
//check feilds for emptyness 
$email= $obj->{'email'};
$pass = $obj->{'pass'};
$ign = $obj->{'ign'};


       if(!isset($email) || !isset($pass) || !isset($ign)){
	
	    header("HTTP/1.0 406 Not Acceptable");
	    return;
	
        }
     
        
        $email = mysql_real_escape_string($email);
        $pass = mysql_real_escape_string($pass);
        $ign = mysql_real_escape_string($ign);
        
        //add the registering user 
        
           $q = mysql_query("insert into user (email,password,ign) values('$email','$pass','$ign')");
	
      //$q = mysql_query("select * from user");
      
      if($q === false){
      	   print mysql_error();
      	   
	    header("HTTP/1.0 406 Not Acceptable");
	    return;
	}
	
	 header("HTTP/1.0 202 Accepted");
	 $encoded = json_encode("");
         header('Content-type: application/json');
         exit($encoded);
	
        
       
?>
