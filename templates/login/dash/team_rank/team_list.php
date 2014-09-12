<?php
 $query = mysql_query("select TeamName, Wins, Losses, TeamStatus from Teams");
 $count = mysql_num_rows($query);
  
 if($count == 0) echo "<h2 style='text-align:center;'> No Teams Found</h2>";
 else{
 	 
    //print header of table	 
     echo "<div class='table-responsive'><table class='table table-bordered'> <thead><tr><th>Team Name</th><th>Wins</th><th>Losses</th><th>Status</th>
<th> </th></tr></thead><tbody>";	 
      
   while ($row = mysql_fetch_array($query)) 
   {     
     echo "<tr>";
     echo "<td>".$row['TeamName']."</td>";  
     echo "<td><span class='badge win'>".$row['Wins']."</span></td>";
     echo "<td><span class='badge loss'>".$row['Losses']."</span></td>";
     echo "<td>".$row['TeamStatus']."</td>";
     echo "<td><a href='#'>view profile</a></td>";
     echo "</tr>";           
   } 	 
 	 echo " </tbody></table></div>";
 }

?>



	    
		  
		
