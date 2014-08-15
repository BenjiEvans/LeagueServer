<?php
session_start();
//establishing database connection
	$db = "leagueserver";
	
	$conn = mysql_connect("localhost","LeagueAdmin","password");
	
	if($conn)
		{
			mysql_select_db($db,$conn);
		}
		else
		{
			die('Unable to connect the database'.mysql_Error());
		}
?>




<?php

 
 //get the user's submitted json 
 $json = file_get_contents('php://input');
 $obj = json_decode($json);

//check feilds for emptyness 
 
print $obj->{'email'};
print $obj->{'pass'};

$emailJSON = $obj->{'email'};
$passJSON = $obj->{'pass'};

           if(!isset($emailJSON) || !isset($passJSON)){
	
	       header("HTTP/1.0 406 Not Acceptable");
	       return;
	
            }

	$queryTodb = mysql_query("select * from user where email ='".mysql_real_escape_string($emailJSON)."'");
	
	$count = mysql_num_rows($queryTodb);    //fetch no. of rows for that email id 
		
	//if count is zero that means no user exists
	if($count==0){
		header("HTTP/1.0 404 Not Found");
		return;
	}
	else
	{	
		if($count > 1){
		header("HTTP/1.0 500 Internal Server Error");
		return;}
		
		$row = mysql_fetch_array($queryTodb);
		
		if($row['password'] == $passJSON)    //compare both password one from HTML page and other from fetched records from db
		{
			  header("HTTP/1.0 202 Accepted");
			 return;

		}
		else
		{
			header("HTTP/1.0 401 Unauthorized");
				return;
		}
		
	}



?>
