<?php //get team info
 
 //print header 
 echo "<h1 style='display:inline'> <span class='text-capitalize'>$team</span></h1> <button type='button' class='btn btn-danger team_rank_btn leave' style='color:rgb(0,0,0)'><img src='../img/glyphicons_007_user_remove.png'> Leave Team</button><hr class='featurette-divider'>";
 
?>

<?php //append memebsers 
  echo "<div style='clear:left;'>";
  echo "<div class='panel-group' id='accordion'>";
  
  //print members
  $mem_query = $mysqli->query("select * from Users where team='$team'");
  //check to see if the user is the captain 
   $query = $mysqli->query("select captain from Teams where name='$team'");
   $r = $query->fetch_assoc();
   $captain = $r["captain"];


  while($row = $mem_query->fetch_assoc())
  {
  	echo "<div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'>";
  	echo "<a data-toggle='collapse' data-parent='#accordion' href='#mem".$row['id']."'><span class='text-capitalize'>".$row['ign']."</span></a></h4></div>";
  	echo "<div id='mem".$row['id']."' class='panel-collapse collapse'><div class='panel-body'>";
  	//print buttons if captain of the team. dont print buttons for yourself
  	if( $captain == $id && $row['id'] != $id )
  	{
  	 echo "<p><button type='button' class='btn btn-danger team_rank_btn remove' style='color:rgb(0,0,0)'><img src='/img/glyphicons_007_user_remove.png'> Remove from Team</button>
  	<button type='button' class='btn btn-warning team_rank_btn captain' style='color:rgb(0,0,0)'><img src='/img/glyphicons_043_group.png'> Assign as Captain </button></p>";	
  		
  	}
  	//print closing stuff
  	echo "</div></div></div>";
  }
  
  
  
  echo "</div></div>";
?>

