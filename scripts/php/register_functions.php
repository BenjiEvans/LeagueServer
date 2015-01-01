<?php
function getRandomString(){//function to generate salt
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';
  $length = rand(5,10);
  for ($i = 0; $i < $length; $i++) $randomString .= $characters[rand(0, strlen($characters) - 1)];        	
return $randomString;
}

function isValidEmail($email){
 $parts = explode('@',$email);
 $domain = $parts[1];
return strtolower($domain) == "calstatela.edu";
}

function isRegistered($email, $ign){
global  $mysqli;
   $email = $mysqli->real_escape_string(trim($email));
   $ign = $mysqli->real_escape_string(trim($ign));
        //check to see if the user registering already exsists
   $result = $mysqli->query("select id from Users where ign='$ign' or email='$email'");
   if($result->num_rows > 0 || strcasecmp($ign,"root") == 0)
   {
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

function send_activation($email,$ign,$hash){
  //send email confirmation 
         $to = $email;
         $from = "autoreply@csulaleagueoflegends.x10.mx";
         $subject = "CSULA League of Legends Account Activation!";
         $message = "<html><head></head><body><h1> Welcome Summoner!</h1>Please click <a target='_blank' style='color:gold' href='http://www.csulaleagueoflegends.x10.mx/activate.php?ign=$ign&auth=$hash'>here</a> to activate your account.</body></html>";
         $headers = "From: $from\n";
         $headers .= "MIME-Version: 1.0\n";
         $headers .= "Content-type: text/html; charset=iso-8859-1\n";
	 mail($to,$subject, $message, $headers);
}
?>
