<div class="col-sm-3 col-md-2 sidebar" style='background-color:rgba(255,255,255,.5)'>
     <ul class="nav nav-sidebar">
     <li id='overview' class="dash_link active"><a href="#">Overview</a></li>
     <li id='blogy' class="dash_link"><a href="#">Blog</a></li>
     <li id='team_rank' class='dash_link'><a href='#'>Team</a></li>
     
     <li id='event' class="dash_link">
    <!-- <a href="#">Events -->
     <?php 
    
     /* $query = $mysqli->query("select count(EventID) as total from Events");
      $count= $query->fetch_assoc();*/
      //    echo "<span class='badge'>0</span>";
       //$query->close();
     ?>
    <!-- </a>
     </li> -->
     <?php 
     
      // if(strcmp($status,"Root") != 0)
     //  {
       	     echo "<li id='note' class='dash_link'><a href='#'>Notifications "; 
       	 /*    $ign = $_SESSION['user']->name();
       	     $query = $mysqli->query("select count(UserID) as total from Notifications where UserID =(select UserID from Users where Ign ='$ign') and Respond=0");
       	     $count = $query->fetch_assoc();*/
	      $query = $mysqli->query("select count(recipient) as total from Notes where recipient=(select id from Users where ign ='$ign')");
       	     $count = $query->fetch_assoc();
       	     echo "<span id='note_count' class='badge'>".$count['total']."</span>"; 
       	     echo "</a></li>";
       	     $query->close();
    //   }
       
     ?>
     <?php 
      
     if($status == 1) echo "<li id='control_panel' class='dash_link'><a href='#'>Control Panel</a></li>";
     	     
     	    ?>
     </ul>
</div>
