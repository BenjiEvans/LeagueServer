<?php
  echo "<div style='clear:left;'>";
  echo "<h2> <em> Members</em></h2>";
  echo "<div class='panel-group' id='accordion'>";
  
  //print members
  $results = $mysqli->query("select UserID, Ign, Wins, Losses, Score from Users where TeamID=".$_SESSION['user']->team);
  //check to see if the user is the captain 
   $query = $mysqli->query("select UserID from Teams where TeamID=".$_SESSION['user']->team." and UserID=(select UserID from Users where Ign='".$_SESSION['user']->name()."')");
   if($query->num_rows == 1)$captain = true;
   else if($query->num_rows == 0) $captain = false;
  while($row = $results->fetch_assoc())
  {
  	echo "<div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'>";
  	echo "<a data-toggle='collapse' data-parent='#accordion' href='#mem".$row['UserID']."'><span class='text-capitalize'>".$row['Ign']."</span></a></h4></div>";
  	echo "<div id='mem".$row['UserID']."' class='panel-collapse collapse'><div class='panel-body'>";
  	//print rank
  	if(is_null($row['Score'])) echo "<h3>Not Ranked</h3>";
  	else{
           $query = $mysqli->query("select count(UserID) as rank from Users where Score >".$row['Score']);	
           $rank = $query->fetch_assoc();
           $actual_rank = $rank['rank'] + 1;
           echo "<h3> Club Rank: <span class='text-warning'>$actual_rank</span></h3>";
  	}
  	//print record
  	echo "<p> <span class='text-success'>Wins: ".$row['Wins']."</span> , <span class='text-danger'>Losses: ".$row['Losses']."</span></p>";
  	//print buttons (no need to print buttons for yourself)
  	if( $captain && strcasecmp($_SESSION['user']->name(),$row['Ign']))
  	{
  	 echo "<p><button type='button' class='btn btn-danger team_rank_btn remove' style='color:rgb(0,0,0)'><img src='/img/glyphicons_007_user_remove.png'> Remove from Team</button>
  	<button type='button' class='btn btn-warning team_rank_btn captain' style='color:rgb(0,0,0)'><img src='/img/glyphicons_043_group.png'> Assign as Captain </button></p>";	
  		
  	}
  	//print closing stuff
  	echo "<a href='#'> View profile</a></div></div></div>";
  }
  
  
  
  echo "</div></div>";

?>






<!--


<div style='clear:left;'>
            <h2> <em> Members</em></h2>
            
            <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <img src='../img/glyphicons_332_certificate.png'>
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          speedy847
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
     
      <h3> Club Rank: <span class="text-warning">1</span></h3>
      <p> <span class="text-success">Wins: 5</span> , <span class="text-danger">Losses: 6</span></p>
      <p> 
         <button type="button" class="btn btn-danger team_rank_btn remove" style='color:rgb(0,0,0)'><img src='../img/glyphicons_007_user_remove.png'> Remove from Team</button> 
         <button type='button' class='btn btn-warning team_rank_btn captain' style='color:rgb(0,0,0)'><img src='../img/glyphicons_043_group.png'> Assign as Captain </button>
      </p>
      <a href='#'> View profile</a>
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          JinxIt
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          MorgMaster847
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
      
      </div>
    </div>
  </div>
</div>
            
          </div> -->
