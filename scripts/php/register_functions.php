<?php

function getRandomString(){//function to generate salt
   	   	   
        	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        	$randomString = '';
        	$length = rand(5,10);
        	for ($i = 0; $i < $length; $i++) 
        	{
        		$randomString .= $characters[rand(0, strlen($characters) - 1)];
        	}
        	return $randomString;
        }

function isValidEmail($email){
//TODO
return true;

}

function isRegistered($email, $ign){

global  $mysqli;

	$email = $mysqli->real_escape_string(trim($email));
	$ign = $mysqli->real_escape_string(trim($ign));
        //check to see if the user registering already exsists
        $result = $mysqli->query("select id from Users where ign='$ign' or email='$email'");
       
        if($result->num_rows > 0 || strcasecmp($ign,"root") == 0){
        	 $result->close();
        	return true;
        }



return false;
}

function addUser($email,$ign,$phash,$salt){
global  $mysqli;
	$email = $mysqli->real_escape_string(trim($email));
	$ign = $mysqli->real_escape_string(trim($ign));
return $mysqli->query("insert into Users (email,ign,status,pass,salt,active,reg_date,team) values('$email','$ign',null,'$phash','$salt',0,now(),null)");
}



?>
