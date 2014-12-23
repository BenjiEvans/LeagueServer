<div class='team_rank' hidden>
               
               <?php
                  /*$query = $mysqli->query("select TeamID from Users where Ign='".$_SESSION['user']->name()."'");
                  $result = $query->fetch_assoc();
                  if($_SESSION["user"]->hasTeam()){
                  	require("../templates/login/dash/team_rank/profile.php");
                  	require("../templates/login/dash/team_rank/members.php"); 
                  	require("../templates/login/dash/team_rank/match_history.php");
                  	
                  }else{
                      echo "
          <h1 style='text-align:center;'> You are not currently part of a team</h1>
          <button type='button' class='btn btn-warning btn-lg btn-block' id='browse_team'>Browse Teams</button>
          <button type='button' class='btn btn-default btn-lg btn-block' id='create_team'>Create Team</button>
          <div id='team_list' hidden> </div>";
                  	  
                  }*/
		/*$query = $mysqli->query("select team from Users where ign='".$_SESSION['user']."'");
                $result = $query->fetch_assoc();*/
		if(is_null($team)){
			 echo "
          			<h1 style='text-align:center;'> You are not currently part of a team</h1>
          <button type='button' class='btn btn-warning btn-lg btn-block' id='browse_team'>Browse Teams</button>
          <button type='button' class='btn btn-default btn-lg btn-block' id='create_team'>Create Team</button>
          <div id='team_list' hidden> </div>";
		}else{

		//TODO
			require("../templates/dash/containers/teams/profile.php");
                  	//require("../templates/dash/members.php"); 

		}
            
               ?>
</div>
