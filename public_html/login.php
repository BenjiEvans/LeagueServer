<?php session_start();?>
<?php require("../scripts/php/mysql_connect.php")?>
<?php require("../scripts/php/json_functions.php")?>
<?php require("../models/user.php") ?> 

<?php
 //get the user's submitted json 
 $json = file_get_contents('php://input');
 $obj = json_decode($json);

//check feilds for emptyness 
$ignJSON = $obj->{'ign'};
$passJSON = $obj->{'pass'};

       if(!isset($ignJSON) || !isset($passJSON)) returnJSON("HTTP/1.0 406 Not Acceptable","");
        

	$queryTodb = mysql_query("select * from user where ign ='".mysql_real_escape_string($ignJSON)."'");
	
	 define("USER","root");//defines a constant variable named USER with the value "root"
         define("PASS","root");// defines another constant variable named PASS with the value "password"
         
         //check to see if root is loging in 
         if($ignJSON == USER && $passJSON == PASS){
          
         	 //login as root (save root object in session)
         	  $_SESSION["user"] = new User("Root",0,0,"Root");
         	  returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=>'Loging in as root user', 'url'=>'/dash.php'));
         	 
         }
	
	$count = mysql_num_rows($queryTodb);    //fetch no. of rows for that email id 
		
	//if count is zero that means no user exists
	if($count==0) returnJSON("HTTP/1.0 404 Not Found","");
	else
	{	
	    if($count > 1) returnJSON("HTTP/1.0 500 Internal Server Error","more than one user has that ign");
	    		
	    $row = mysql_fetch_array($queryTodb);
	   	   		
            if( $row['password'] == crypt($passJSON,$row['salt']))//compare both password one from HTML page and other from fetched records from db
	    {
	    	        //store in session
	    	        $_SESSION["user"] = new User($row['ign'],$row['wins'],$row['losses'],$row['status']);
	    	    
			//should actually redirect to user panel view 
			 returnJSON("HTTP/1.0 202 Accepted",array('status'=>202, 'msg'=>'Loging successful!', 'url'=>'/dash.php'));
	     }else{
			returnJSON("HTTP/1.0 401 Unauthorized", "");
				
	     }
	}



?>
