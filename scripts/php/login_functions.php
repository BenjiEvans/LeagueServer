<?php
function isActivated($ign){
//TODO
return true;
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
