<h2 class="sub-header">Club Ranking</h2>
   <div class="table-responsive">
       <table class="table table-striped">
           <thead>
             <tr>
               <th># Rank</th>
               <th>Ign</th>
               <th>Wins</th>
               <th>Losses</th>
               <th>Status</th>
               <th>Current Team</th>
             </tr>
           </thead>
           <tbody>
                <?php   
                  
                $query = mysql_query("select ign, user.wins, user.losses, name, user.status from user left join team on user.team_id where user.score is not null order by user.score desc");
                $count = mysql_num_rows($query);
                if($count == 0) echo "No User's found";
                else{
                              
                  
                   $i = 1;
                   $cur_user = $_SESSION['user']->name();
                  while ($row = mysql_fetch_array($query)) 
                  {
                  	  
                     $name = $row["ign"];                    	  
                     echo "<tr><td>$i</td>";
                     if(strcmp($name, $cur_user) == 0) echo"<td><span style='font-weight: bold;'>$name</span></td>";
                     else echo "<td>$name</td>";                
                     echo "<td><span class='badge win'>".$row["wins"]."</span></td>";
                     echo "<td><span class='badge loss'>".$row["losses"]."</span></td>";
                     echo "<td>".$row["status"]."</td>";
                     if(is_null($row['name']))echo "<td></td>";
                     else echo "<td>".$row['name']."</td>";
                     echo "</tr>";
                     $i+=1;
                  }
                }
                
                
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