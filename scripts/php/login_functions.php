<?php
function isActivated($ign){

global $mysqli;

$query = $mysqli->query("select active from Users where ign='$ign'");

$row = $query->fetch_assoc();

return $row['active'] == 1; 

}

function isAuthorized($ign, $pass){

 global $mysqli;
 $ign = $mysqli->real_escape_string($ign);

	$result = $mysqli->query("select * from Users where ign ='$ign'");
	$count = $result->num_rows;    //fetch no. of rows for that email id 
		
	//if count is zero that means no user exists
	if($count==0) return false;
	else
	{
	    $row = $result->fetch_assoc();
	   //check password   		
            if( $row['pass'] == crypt($pass,$row['salt']))
	    {
	    	     $result->close();
	    	     return true;
	     }else{
	     	   $result->close();
	     	  return false;
	     }
	}


}


?>
