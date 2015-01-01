<?php session_start();?>
<?php require("../scripts/php/mysql_connect.php");?>
<?php require("../scripts/php/json_functions.php")?>
<?php require("../scripts/php/login_functions.php"); ?>
<?php require("../scripts/php/register_functions.php") ?>
<?php
 //get the user's submitted json 
 $json = file_get_contents('php://input');
 $obj = json_decode($json);
//check feilds for emptyness 
$ign = $obj->{'ign'};
$pass = $obj->{'pass'};
       if(!isset($ign) || !isset($pass)) returnJSON("HTTP/1.0 406 Not Acceptable","");
       //if the user is trying to login with unregistered account 
	if(!isRegistered('null',$ign)){
		$mysqli->close();
		returnJSON("HTTP/1.0 404 Not Found",array('status'=>404,'msg'=>'ign not registered'));
	}
         if(isAuthorized($ign, $pass)){
		//print $ign."hello\n";
		if(isActivated($ign)){
	          
		   //store users name in session 
		    $ign = $mysqli->real_escape_string($ign);
		   // print $ign;
		    $mysqli->close();
		   $_SESSION["user"] = $ign;
		   returnJSON("HTTP/1.0 202 Accepted",array('status'=>202, 'msg'=>'Loging successful!', 'url'=>'/dash.php'));
		}
		$mysqli->close();
		returnJSON("HTTP/1.0 400 Bad request", array('status'=>400, 'msg'=>'not activated'));
	  }
	
	$mysqli->close();
	returnJSON("HTTP/1.0 401 Unauthorized", array('status'=>401, 'msg'=>'Loging unsuccessful!'));
?>
