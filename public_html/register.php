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
	    $mysqli->close();
	    returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Some fields are empty', 'status'=> 406));
	   
        }else if (strlen(trim($email)) == 0 || strlen(trim($pass)) == 0 || strlen(trim($ign)) == 0)returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Some fields are empty', 'status'=> 406));
        //check that the email is calstate la email	
        	
     
        $email = $mysqli->real_escape_string(trim($email));
        $pass = $mysqli->real_escape_string(trim($pass));
        $ign = $mysqli->real_escape_string(trim($ign));
        
        //check to see if the user registering already exsists
        $result = $mysqli->query("select UserID from Users where Ign='$ign' or Email='$email'");
       
        if($result->num_rows > 0 || strcasecmp($ign,"root") == 0){
        	 $result->close();
        	 $mysqli->close();
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
        
        if($mysqli->query("insert into Users (Email,Password,Ign,Register,Salt,Activate) values('$email','$passHash','$ign',now(),'$salt',0)")){
        	
        //send email confirmation 
         $to = $email;
         $from = "autoreply@csulaleagueoflegends.x10.mx";
         $subject = "CSULA League of Legends Account Activation!";
         $message = "<html>
<head> </head>
<body>
 
   <h1> Welcome Summoner!</h1>
   It seems that you have registered 
   Please click <a target='_blank' style='color:gold' href='http://www.csulaleagueoflegends.x10.mx/activate.php?ign=$ign&auth=$passHash'>here</a> to activate your account.

</body>
</html>";
         $headers = "From: $from\n";
         $headers .= "MIME-Version: 1.0\n";
         $headers .= "Content-type: text/html; charset=iso-8859-1\n";

	 mail($to,$subject, $message, $headers);
         $mysqli->close();	
         returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'You have been added to our database'));
        	
        }else{
           $mysqli->close();
          returnJSON("HTTP/1.0 503 Service Unavailable", array('msg'=>'We are having problems with the server at the moment','status'=>503));
           
        }     	 
       
?>

