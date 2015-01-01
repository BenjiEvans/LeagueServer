<div class="col-sm-3 col-md-2 sidebar" style='background-color:rgba(255,255,255,.5)'><ul class="nav nav-sidebar"><?php 
   if($status == 1){
      echo'<li id="overview" class="dash_link active"><a href="#">Overview</a></li>';
      echo' <li id="blogy" class="dash_link"><a href="#">Blog</a></li>';
    }else {
      echo' <li id="blogy" class="dash_link active"><a href="#">Blog</a></li>';
     }
?><li id='team_rank' class='dash_link'><a href='#'>Team</a></li><li id='event' class="dash_link"><?php 
echo "<li id='note' class='dash_link'><a href='#'>Notifications "; 
$query = $mysqli->query("select count(recipient) as total from Notes where recipient=(select id from Users where ign ='$ign')");
$count = $query->fetch_assoc();
echo "<span id='note_count' class='badge'>".$count['total']."</span>"; 
echo "</a></li>";
$query->close();
?></ul></div>
