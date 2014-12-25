
<?php //relies on user_info.php

function print_team_profile($name){

global $mysqli;
global $team;
//print header 
echo "<h1 style='display:inline'> <span class='text-capitalize'>$name</span></h1>";
$iden = "team-$name";
if(!is_team_full($name)){

  if(has_sent_request($name) || !is_null($team)) echo "<span id='$iden' ><button disabled type='button' class='btn btn-success team_rank_btn join' style='color:rgb(0,0,0)'><img src='/img/glyphicons_006_user_add.png'> <span>Join Request Sent</span></button></span>";
  else echo "<span id='$iden' ><button type='button' class='btn btn-success team_rank_btn join' style='color:rgb(0,0,0)'><img src='/img/glyphicons_006_user_add.png'> <span>Join Team</span></button><span>";

}

echo "<hr class='featurette-divider'>";
 
  echo "<div style='clear:left;'>";
  echo "<div class='panel-group' id='accordion2'>";
  
  //print members
  $mem_query = $mysqli->query("select * from Users where team='$name'");
 


  while($row = $mem_query->fetch_assoc())
  {
  	echo "<div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'>";
  	echo "<a data-toggle='collapse' data-parent='#accordion' href='#mem".$row['id']."'><span class='text-capitalize'>".$row['ign']."</span></a></h4></div>";
  	echo "<div id='mem".$row['id']."' class='panel-collapse collapse'><div class='panel-body'>";
  	  	
  	//print closing stuff
  	echo "</div></div></div>";
  }
  
  
  
  echo "</div></div>";




}

function is_team_full($name){
global $mysqli;
$query = $mysqli->query("select count(*) as total from Users where team='$name' ");
$row = $query->fetch_assoc();
$result = $row['total'] == 5;
$query->close();
return $result;

}

function has_sent_request($name){
global $mysqli;
global $id;

$q = $mysqli->query("select captain from Teams where name='$name'");
$row = $q->fetch_assoc();
$captain = $row['captain'];
$q->close();
$query = $mysqli->query("select count(*) as total from Notes where (sender=$id and type=1 and recipient=$captain) or (sender=$captain and type=2 and recipient=$id)");
$result = $query->fetch_assoc();
$r = $result['total'] >= 1;
$query->close();
return $r;


}



?>
