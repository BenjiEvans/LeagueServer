<div class="col-sm-3 col-md-2 sidebar">
     <ul class="nav nav-sidebar">
     <li id='overview' class="dash_link active"><a href="#">Overview</a></li>
     <li id='blog' class="dash_link"><a href="#">Blog</a></li>
     <li id='team_rank' class="dash_link"><a href="#">Team Rank</a></li>
     <li id='event' class="dash_link"><a href="#">Events <span class='badge'> display # of posted events</span></a></li>
     <li id='event' class="dash_link"><a href="#">Noifications <span class='badge'> display # of notifcations</span></a></li>
     <?php 
       $status =$_SESSION["user"]->status();
     if(strcmp($status,"Root") == 0 || strcmp($status,"Admin") == 0) echo "<li id='control_panel' class='dash_link'><a href='#'>Control Panel</a></li>";
     	     
     	    ?>
     </ul>
</div>
