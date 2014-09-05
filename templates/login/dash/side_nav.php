<div class="col-sm-3 col-md-2 sidebar">
     <ul class="nav nav-sidebar">
     <li id='overview' class="dash_link active"><a href="#">Overview</a></li>
     <li id='blogy' class="dash_link"><a href="#">Blog</a></li>
     <li id='team_rank' class="dash_link"><a href="#">Team Rank</a></li>
     <li id='event' class="dash_link">
     <a href="#">Events 
     <?php 
     //get status so we know what to show on the side nav bar
      $status =$_SESSION["user"]->status();
      $query = mysql_query("select count(EventID) as total from Events");
      $count=mysql_fetch_assoc($query);
          echo "<span class='badge'>".$count['total']."</span>";
     ?>
     </a>
     </li>
     <?php 
     
       if(strcmp($status,"Root") != 0)
       {
       	     echo "<li id='note' class='dash_link'><a href='#'>Noifications"; 
       	     $ign = $_SESSION['user']->status();
       	     $query = mysql_query("select count(N.UserID) as total from Notifications as N where UserID =(select UserID from Users where UserID ='$ign')"); 
       	     echo "<span class='badge'>".$count['total']."</span>"; 
       	     echo "</a></li>";
       }
       
     ?>
     <?php 
      
     if(strcmp($status,"Root") == 0 || strcmp($status,"Admin") == 0) echo "<li id='control_panel' class='dash_link'><a href='#'>Control Panel</a></li>";
     	     
     	    ?>
     </ul>
</div>
