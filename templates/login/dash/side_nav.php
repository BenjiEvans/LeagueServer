<div class="col-sm-3 col-md-2 sidebar" style='background-color:rgba(255,255,255,.5)'>
     <ul class="nav nav-sidebar">
     <?php  
     //get status so we know what to show on the side nav bar
      $status = $_SESSION["user"]->status();
      ?>
     <li id='overview' class="dash_link active"><a href="#">Overview</a></li>
     <li id='blogy' class="dash_link"><a href="#">Blog</a></li>
     <?php //root user cannot create a team
       if(strcasecmp($status,"Root") != 0)echo "<li id='team_rank' class='dash_link'><a href='#'>Team Rank</a></li>";
     ?>
     <li id='event' class="dash_link">
     <a href="#">Events 
     <?php 
    
      $query = $mysqli->query("select count(EventID) as total from Events");
      $count= $query->fetch_assoc();
          echo "<span class='badge'>".$count['total']."</span>";
       $query->close();
     ?>
     </a>
     </li>
     <?php 
     
       if(strcmp($status,"Root") != 0)
       {
       	     echo "<li id='note' class='dash_link'><a href='#'>Notifications "; 
       	     $ign = $_SESSION['user']->name();
       	     $query = $mysqli->query("select count(UserID) as total from Notifications where UserID =(select UserID from Users where Ign ='$ign') and Respond=0");
       	     $count = $query->fetch_assoc();
       	     echo "<span class='badge'>".$count['total']."</span>"; 
       	     echo "</a></li>";
       	     $query->close();
       }
       
     ?>
     <?php 
      
     if(strcasecmp($status,"Root") == 0 || strcasecmp($status,"Admin") == 0) echo "<li id='control_panel' class='dash_link'><a href='#'>Control Panel</a></li>";
     	     
     	    ?>
     </ul>
</div>
