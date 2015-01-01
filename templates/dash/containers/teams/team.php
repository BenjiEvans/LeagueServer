<div class='team_rank' hidden><?php
 if(is_null($team)) echo "<h1 style='text-align:center;'> You are not currently part of a team</h1><button type='button' class='btn btn-warning btn-lg btn-block' id='browse_team'>Browse Teams</button><button type='button' class='btn btn-default btn-lg btn-block' id='create_team'>Create Team</button><div id='team_list' hidden></div>";
  else require("../templates/dash/containers/teams/profile.php");
?></div>
