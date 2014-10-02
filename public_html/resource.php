<?php require("../models/user.php");
require("../scripts/php/login_check.php");
require("../scripts/php/mysql_connect.php");


   if(isset($_GET['rq'])){
   	   
       $param = $_GET['rq'];
             
       if($param == 'logout'){//logout 
   	   
   	   	   unset($_SESSION["user"]);
   	   	   $mysqli->close();
   	   	   header("Location: /index.php");
   	   	   exit();
       }
       
       if($param == 'blog' ){// get next blog posts 
       	
       	       if(isset($_GET['id'])){
       	          
       	       	$id = $_GET['id'];  
       	       	if(!is_numeric($id)){//id must be a number other wise exceptions will occur 
       	         		
       	       	  $mysqli->close();	
       	       	 header("HTTP/1.0 406 Not Acceptable");
       	       	 exit();
       	       	}
       	       	$limit = 10; 
                $result = $mysqli->query("select * from Blog where Flagged != 1 and BlogID < $id order by BlogID desc limit $limit");
                $count = $result->num_rows;
                if($count == 0) echo "";
                else{
               
                  while ($row = $result->fetch_assoc()) 
                  {                	  
                    echo "<div class='blog-post' id='".$row['BlogID']."'>";
                    echo "<h2 class='blog-post-title'>".$row['Title']."</h2>";
                    
                    $date = explode("-",$row['PublishDate']);
                    //break date into month,day,and year
                    $y = $date[0];
                    $m = getMonth($date[1]);
                    $d = $date[2];
                    
                    echo "<p class='blog-post-meta'> $m $d, $y by ";
                    if(strcmp($row['Author'],"Root") == 0)echo "Root</p>";
                    else echo "<a href='#'>".$row['Author']."</a></p>";
                    echo "<p>".$row['Post']."</p>";
                    echo "</div>";
            
                  }
                  
                  //if($count < $limit) echo file_get_contents("../templates/main/blog/blog_footer.php");
                }
       	       }
       	       $result->close();
       	       $mysqli->close();       	 
       	       exit();    
       }
       
       if($param == 'team_list'){// get team listing 
       	       
       	require("../templates/login/dash/team_rank/team_list.php");
       	  exit();
       }
       
       if($param == 'team'){//view team's profile
       	   
       	  if(isset($_GET['id'])){
       	       	       
       	       	$id = $_GET['id']; //team's id 
       	       	if(!is_numeric($id)){//id must be a number other wise exceptions will occur 
       	         		
       	       	  $mysqli->close();	
       	       	 header("HTTP/1.0 406 Not Acceptable");
       	       	 exit();
       	       	}
       	       	//get the team specified 
       	       	$query = $mysqli->query("select U.Ign as Captain, T.Wins, T.Losses, T.Score, T.TeamStatus, T.TeamName from Users as U join Teams as T where U.UserID=T.UserID and T.TeamID='$id'");
       	       	if($query->num_rows == 0){
       	       	 //leave if no team with that id is found 
       	       	 $query->close();			
       	       	 $mysqli->close();	
       	       	 header("HTTP/1.0 404 Not Found");
       	       	 exit();
       	       	}
       	       	// print the profile 
       	       	 $info = $query->fetch_assoc();
                 $query->close();
		 //print header 
		 echo "<h1> <span class='text-capitalize'>".$info['TeamName']."</span> <em><span class='text-muted officer'>".$info['TeamStatus']."</span></em></h1> <hr class='featurette-divider'>";
		 //team image 
		 echo "<img class='featurette-image img-responsive' src='/img/team_default.png' alt='Generic placeholder image' style='border:solid;float:left'>";
		 // profile data 
		 echo "<div id='$id' style='float:left;margin-left:10px;'>";
		 
		 
		 //append rank 
		 if(is_null($info['Score']))echo "<h2 style='font-family:Fertigo'><em>Not Ranked</em></h2>";
		 else {
		
		    $result=$mysqli->query("select count(TeamID) as rank from Teams where Score is not null and Score > ".$info['Score']);
		    $rank = $result->fetch_assoc(); 
		    $actual_rank = $rank['rank'] +1;
		    echo "<h2> <span style='font-family:Fertigo'>Club Rank</span> : <span class='text-muted officer'>$actual_rank</span></h2>";
		    $result->close();
		 }
		 
		 //append captain
		  echo "<h2> <span style='font-family:Fertigo'>Team Captain</span>: <span class='text-warning text-capitalize'>".strtolower($info['Captain'])."</span> </h2>";
		 //append wins and losses 
		  echo " <h3> <span class='text-success' > Wins: ".$info['Wins']."</span></h3>
		   <h3> <span class='text-danger'> Losses: ".$info['Losses']." </span></h3>";
		 //append join button 
		 //check to see if the user has already made a request to the team 
		 $query = $mysqli->query("select count(NoteID) as count from  RequestDispatcher where TeamID=$id and UserID=(select UserID from Users where Ign='".$_SESSION['user']->name()."')");
		 $count = $query->fetch_assoc();
		 if($count['count'] == 0){
		   $query->close();
		   $query = $mysqli->query("select count(UserID) as count from Users where TeamID=$id");
		   $count = $query->fetch_assoc();
		   if($count['count'] < 5 && !$_SESSION['user']->hasTeam())echo "<button type='button' class='btn btn-success team_rank_btn join' style='color:rgb(0,0,0)'><img src='/img/glyphicons_006_user_add.png'> <span>Join Team</span></button>";
		   $query->close();	 
		 }else{// echo a disabled button 
		  
		    echo "<button disabled type='button' class='btn btn-success team_rank_btn join' style='color:rgb(0,0,0)'><img src='/img/glyphicons_006_user_add.png'> <span>Join Request Sent</span></button>";
		    		 	 
		 }
		 echo "</div>";
		 // members of the team 
		  echo "<div style='clear:left;'>";
		  echo "<h2> <em> Members</em></h2>";
		  echo "<div class='panel-group' id='accordion'>";
		  
		  //print members
		  $results = $mysqli->query("select UserID, Ign, Wins, Losses, Score from Users where TeamID=".$id);
		 
		  while($row = $results->fetch_assoc())
		  {
			echo "<div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'>";
			echo "<a data-toggle='collapse' data-parent='#accordion' href='#mem".$row['UserID']."'><span class='text-capitalize'>".$row['Ign']."</span></a></h4></div>";
			echo "<div id='mem".$row['UserID']."' class='panel-collapse collapse'><div class='panel-body'>";
			//print rank
			if(is_null($row['Score'])) echo "<h3>Not Ranked</h3>";
			else{
			   $query = $mysqli->query("select count(UserID) as rank from Users where Score >".$row['Score']);	
			   $rank = $query->fetch_assoc();
			   $actual_rank = $rank['rank'] + 1;
			   echo "<h3> Club Rank: <span class='text-warning'>$actual_rank</span></h3>";
			}
			//print record
			echo "<p> <span class='text-success'>Wins: ".$row['Wins']."</span> , <span class='text-danger'>Losses: ".$row['Losses']."</span></p>";
			
			//print closing stuff
			echo "<a href='#'> View profile</a></div></div></div>";
		  }
		  
		  
		  
		  echo "</div></div>";

		 
		 
		$mysqli->close();
		//
		
		
		
		
		
		
		
		
		
		
		header("HTTP/1.0 202 Accepted");
		exit();
				
       	    }
       	       
       }
       
  
       
   }


function getMonth($month){
     	     
     	     switch($month){
     	     	     
     	   case 1:
     	     	   return "January";
     	   case 2:
     	   	   return "Febuary";
     	   case 3:
     	   	   return "March";
     	   case 4:
     	   	   return "April";
     	   case 5: 
     	   	   return "May";
     	   case 6:
     	   	   return "June";
     	   case 7:
     	   	   return "July";
     	   case 8:
     	   	   return "August";
     	   case 9:
     	   	   return "September";
     	   case 10:
     	   	   return "October";
     	   case 11:
     	   	   return "November";
     	   case 12:
     	   	   return "December";
     	     	          	     	     
     	     }
     	     
}
     	
?>
