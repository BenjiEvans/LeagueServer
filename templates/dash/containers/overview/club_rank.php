<div class="table-responsive"><table class="table table-striped"><thead><tr><th>In game name</th><th>Email</th><th>Account Activated</th><th>Current Team</th><th>Status</th></tr></thead><tbody>
<?php   
 $query = $mysqli->query("select ign, team, status, active, email from Users");
 while ($row = $query->fetch_assoc()) {
     $name = $row["ign"];  
     echo "<tr>";
     //print ign 
     if(strcasecmp($name, $ign) == 0)echo"<td><span style='font-weight: bold;'>$name</span></td>";
     else echo "<td>$name</td>";  
     //print email
     echo "<td>".$row['email']."</td>";
     //print activation status
     if($row['active'] == 1)echo "<td>yes</td>";
     else echo "<td>no</td>";
     //print current team 
     if(is_null($row['team']))echo "<td></td>";
     else echo "<td>".$row['team']."</td>";           
     //print status
     if(is_null($row["status"])) echo"<td></td>";
     else if($row["status"] == 1) echo "<td>Officer</td>";
     else if($row["status"] == 2) echo "<td>Collegiate</td>";
     echo "</tr>";
  }
    $query->close();
?>
</tbody></table></div>
