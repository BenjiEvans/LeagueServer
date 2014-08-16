<?php session_start();?>
<?php require("../templates/mysql_connect.php")?>
<?php require("../templates/json_functions.php")?>

<?php
 //get the user's submitted json 
 $json = file_get_contents('php://input');
 $obj = json_decode($json);

//check feilds for emptyness 
$emailJSON = $obj->{'email'};
$passJSON = $obj->{'pass'};

       if(!isset($emailJSON) || !isset($passJSON)){
	
	    returnJSON("HTTP/1.0 406 Not Acceptable","");
        }

	$queryTodb = mysql_query("select * from user where email ='".mysql_real_escape_string($emailJSON)."'");
	
	$count = mysql_num_rows($queryTodb);    //fetch no. of rows for that email id 
		
	//if count is zero that means no user exists
	if($count==0){
		returnJSON("HTTP/1.0 404 Not Found","");
	}
	else
	{	
	
	    if($count > 1)
	    {
		returnJSON("HTTP/1.0 500 Internal Server Error","");
	    }
		
	    $row = mysql_fetch_array($queryTodb);
		
            if($row['password'] == $passJSON)    //compare both password one from HTML page and other from fetched records from db
	    {
			//should actually redirect to user panel view 
			 returnJSON("HTTP/1.0 202 Accepted","");
	     }else{
			returnJSON("HTTP/1.0 401 Unauthorized","");
				
	     }
	}



?>
