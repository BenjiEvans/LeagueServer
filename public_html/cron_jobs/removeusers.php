?php

require_once("../scripts/db_conx.php");

// This block deletes all accounts that do not activate after 7days

$sql = "SELECT id, ign FROM user WHERE register<=CURRENT_DATE - INTERVAL 7 DAY AND activate='0'";

$query = mysqli_query($db_conx, $sql);

$numrows = mysqli_num_rows($query);

if($numrows > 0){

	 while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

	   $id = $row['id'];

	   $ign = $row['ign'];

	   $userFolder = "./users/$ign";

	   if(is_dir($userFolder)) {

          rmdir($userFolder);

      }

	   mysqli_query($db_conx, "DELETE FROM user WHERE id='$id' AND ign='$ign' AND activate='0' LIMIT 1");

	  

    }

}

?>
 
