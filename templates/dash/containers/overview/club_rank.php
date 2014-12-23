<h2 class="sub-header">Club Members</h2>
   <div class="table-responsive">
       <table class="table table-striped">
           <thead>
             <tr>
               <!--<th># Rank</th> -->
               <th>In game name</th>
               <!--<th>Wins</th>
               <th>Losses</th>-->
               <th>Current Team</th>
	       <th>Status</th>
             </tr>
           </thead>
           <tbody>
                <?php   
                  
		  $query = $mysqli->query("select ign, team, status from Users");
		  while ($row = $query->fetch_assoc()) 
                  {
                     $name = $row["ign"];  
		     echo "<tr>";
		     //print ign 
                     if(strcasecmp($name, $ign) == 0)echo"<td><span style='font-weight: bold;'>$name</span></td>";
		     else echo "<td>$name</td>";  
                     
		    //print current team 
			if(is_null($row['team']))echo "<td></td>";
                     else echo "<td>".$row['team']."</td>";

                     //print status
		     if(is_null($row["status"])) echo"<td></td>";
                     else if($row["status"] == 1) echo "<td>Admin</td>";
		     else if($row["status"] == 2) echo "<td>Collegiate</td>";
                     
                     echo "</tr>";
                    // $i+=1;
                  }
                  $query->close();
               /* $query = $mysqli->query("select U.Ign, U.Wins, U.Losses, T.TeamName, U.UserStatus from Users U left join Teams T on U.TeamID = T.TeamID where U.Score is not null order by U.Score desc");
                $count = $query->num_rows;
                if($count == 0) echo "";
                else{
                              
                  
                  // $i = 1;
                   $cur_user = $_SESSION['user'];
                  while ($row = $query->fetch_assoc()) 
                  {
                  	  
                     $name = $row["Ign"];  
                     if(strcasecmp($name, $cur_user) == 0){
                     	//echo "<tr class='info'><td>$i</td>";
                     	echo"<td><span style='font-weight: bold;'>$name</span></td>";
                     }else{
                     	//echo "<tr><td>$i</td>";
                     	echo "<td>$name</td>";  
                     }    
                     echo "<td><span class='badge win'>".$row["Wins"]."</span></td>";
                     echo "<td><span class='badge loss'>".$row["Losses"]."</span></td>";
                     echo "<td>".$row["status"]."</td>";
                     if(is_null($row['TeamName']))echo "<td></td>";
                     else echo "<td>".$row['TeamName']."</td>";
                     echo "</tr>";
                    // $i+=1;
                  }
                  $query->close();
                }
                */
                
                ?>

            <!--  <tr>
                <td>1</td>
                <td> name </td>
                <td><span class="badge win"># of wins</span></td>
                <td><span class="badge loss"># of losses</span></td>
                <td>team name</td>
                </tr> -->
            </tbody>
        </table>
    </div>
