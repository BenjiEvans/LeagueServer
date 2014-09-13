<?php //get team info
 $result = $mysqli->query("select U.Ign as Captain, T.Wins, T.Losses, T.Score, T.TeamStatus, T.TeamName from Users as U join Teams as T where U.UserID=T.UserID and T.TeamID='".$_SESSION['user']->team."'");
 $info = $result->fetch_assoc();
 
 //print header 
 echo "<h1> <span class='text-capitalize'>".$info['TeamName']."</span> <em><span class='text-muted officer'>".$info['TeamStatus']."</span></em></h1> <hr class='featurette-divider'>";
 //team image 
 echo "<img class='featurette-image img-responsive' data-src='holder.js/200x200/auto' alt='Generic placeholder image' style='border:solid;float:left'>";
 // profile data 
 echo "<div style='float:left;margin-left:10px;'>";
 
 
 //append rank 
 if(is_null($info['Score']))echo "<h2 style='font-family:Fertigo'>Not Ranked</h2>";
 else {
    $query->$mysqli->query("select count(UserID) as rank where Score > ".$info['Score']);
    $rank = $query->fetch_assoc(); 
    $actual_rank = $rank['rank'] +1;
    echo "<h2> <span style='font-family:Fertigo'>Club Rank</span> : <span class='text-muted officer'>$actual_rank</span></h2>";
    $query->close();
 }
 
 //append captain
  echo "<h2> <span style='font-family:Fertigo'>Team Captain</span>: <span class='text-warning text-capitalize'>".$info['Captain']."</span> </h2>";
 //append wins and losses 
  echo " <h3> <span class='text-success' > Wins: ".$info['Wins']."</span></h3>
   <h3> <span class='text-danger'> Losses: ".$info['Losses']." </span></h3>";
 //append leave button 
    echo "<button type='button' class='btn btn-danger team_rank_btn leave' style='color:rgb(0,0,0)'><img src='../img/glyphicons_007_user_remove.png'> Leave Team</button>";
    echo "</div>";
$result->close(); 
?>




<!--

<h1> JBlap <em><span class='text-muted officer'>Challenger</span></em></h1> <hr class='featurette-divider'>
          <img class="featurette-image img-responsive" data-src="holder.js/200x200/auto" alt="Generic placeholder image" style='border:solid;float:left'>
          <div style='float:left;margin-left:10px;'>
            <h2> <span style="font-family:Fertigo">Club Rank</span> : <span class="text-muted officer">1</span></h2>
            <h2> <span style="font-family:Fertigo">Team Captain</span>: <span class="text-warning text-capitalize">speedy847</span> </h2>
            <h3> <span class="text-success" > Wins: 5 </span> </h3>
            <h3> <span class="text-danger"> Losses: 2 </span></h3>
             <button type="button" class="btn btn-danger team_rank_btn leave" style='color:rgb(0,0,0)'><img src='../img/glyphicons_007_user_remove.png'> Leave Team</button> 
           
</div>  -->
