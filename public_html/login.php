
<?php
//establishing database connection
	$host = "localhost";
	$username= "LeagueAdmin";
	$password = "password";
	$db = "leagueserver";
	
	$conn = mysql_connect($host,$username,$password);
	
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

 session_start();
 //get the user's submitted json 
 $json = file_get_contents('php://input');
 $obj = json_decode($json);

//check feilds for emptyness 
 
print $obj->{'email'};
print $obj->{'pass'};

$emailJSON = $obj->{'email'};
$passJSON = $obj->{'pass'};

			$queryTodb = mysql_query("select * from user where email = '$emailJSON'");
			$count = mysql_num_rows($queryTodb);    //fetch no. of rows for that email id 
				
				if($count==0)
					{
						die('User not registered'.mysql_error());   //if count is zero that means no user exist
					}
					else
					{	
						$row = mysql_fetch_array($queryTodb);
						
						if (($row['email'] == $emailJSON))//compare both email; one from HTML page and other from fetched from db
								{
									if($row['password'] == $passJSON)    //compare both password one from HTML page and other from fetched records from db
										{
										          header("HTTP/1.0 202 Accepted");

										}
									else
										{
											header("HTTP/1.0 404 Not Found");
										}
								}
					}



?>
