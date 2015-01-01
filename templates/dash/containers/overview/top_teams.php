 <?php
 $query = $mysqli->query("select name, captain from Teams");
 $count = $query->num_rows;
 if($count == 0) echo "<h2><em>No Teams</em></h2>";
 else{ 
     while($team_row = $query->fetch_assoc()){//get the teams
	echo "<table class='table table-bordered' style='width:40%;float:left;margin-right:10px;margin-bottom:10px;'>";
        echo "<thead><tr><th>".$team_row['name']."</th></tr></thead><tbody>";
        $mem_query = $mysqli->query("select ign, id from Users where team='".$team_row['name']."'");
        while($mem_row = $mem_query->fetch_assoc()){ //get each member of the team 
				
	      echo "<tr";
	      if($mem_row['id'] == $team_row['captain']) echo " class='info'";
	      echo "><td>";
	      echo $mem_row['ign'];
	      echo "</td></tr>";
	  }
	  echo "</tbody></table>";
	  $mem_query->close();
       }                  
   }
$query->close();
?>
