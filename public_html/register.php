<?php require("../scripts/php/mysql_connect.php") ?>
<?php require("../scripts/php/json_functions.php") ?>
<?php
  
//get the user's submitted json 
 	$json = file_get_contents('php://input');
 	$obj = json_decode($json);


	//check feilds for emptyness 
	$email= $obj->{'email'};
	$pass = $obj->{'pass'};
	$ign = $obj->{'ign'};


       if(!isset($email) || !isset($pass) || !isset($ign)){//return if empty fields
	
	    returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Some fields are empty', 'status'=> 406));
	   
        }
     
        $email = mysql_real_escape_string(trim($email));
        $pass = mysql_real_escape_string(trim($pass));
        $ign = mysql_real_escape_string(trim($ign));
        
        //check to see if the user registering already exsists
        
        $query = mysql_query("select UserID from Users where Ign='$ign' or Email='$email'");
        
        if(mysql_num_rows($query) > 0 || strcmp($ign,"root") == 0){
        	
        	returnJSON("HTTP/1.0 409 Conflict",array('msg'=>'The ign or email entered is already in use', 'status' => 409));
        }
        
        //add the registering user 
        
        function getRandomString(){
   	   	   
        	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        	$randomString = '';
        	$length = rand(5,10);
        	for ($i = 0; $i < $length; $i++) 
        	{
        		$randomString .= $characters[rand(0, strlen($characters) - 1)];
        	}
        	return $randomString;
   	   
        }
        
        //hash users pass word
        $salt = getRandomString();
        $passHash = crypt($pass,$salt);
        
        $insert = mysql_query("insert into Users (Email,Password,Ign,Register,Salt,Activate) values('$email','$passHash','$ign',now(),'$salt',0)"); 
       
	
        if($insert === false){
      	      
      	    print mysql_error();
	    returnJSON("HTTP/1.0 503 Service Unavailable", array('msg'=>'We are having problems with the server at the moment'.mysql_error(),'status'=>503));
	}
	
	 //send email confirmation (when In production)
	 
	 returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'You have been added to our database'));
	     
         	 
       
?>

