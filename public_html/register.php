<?php require("../scripts/php/mysql_connect.php") //should always go first when db is being used ?>
<?php require("../scripts/php/json_functions.php") ?>
<?php require("../scripts/php/register_functions.php") ?>
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
	if(!isValidEmail($email)){
		$mysqli->close();
		returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Not a csula email..', 'status'=> 406));
         }

        //check to see if email or ign is already registered 
        if(isRegistered($email, $ign)){
             $mysqli->close();
        	returnJSON("HTTP/1.0 409 Conflict",array('msg'=>'The ign or email entered is already in use', 'status' => 409));
	}
        //add the registering user
	$salt = getRandomString();
        $passHash = crypt($pass,$salt);
        $success = addUser($email,$ign,$passHash,$salt);
	if($success){
	   $mysqli->close();
	   send_activation($email,$ign,$passHash);
           returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'You have been added to our database'));
	}else{
           $mysqli->close();
           returnJSON("HTTP/1.0 503 Service Unavailable", array('msg'=>'We are having problems with the server at the moment','status'=>503));
	}       
?>

