<div class='overview'>
           <?php //require("top_teams.php"); ?> 
           <?php //require("club_rank.php"); ?> 

<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Members</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Teams</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home"> <?php require("club_rank.php"); ?> </div>
    <div role="tabpanel" class="tab-pane" id="profile"> <?php require("top_teams.php"); ?> </div>
  </div>

</div> 


</div>
