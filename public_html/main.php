<?php require("../models/user.php") ?>
<?php require("../scripts/php/login_check.php") ?>
<?php require("../scripts/php/json_functions.php")?>
<?php require("../scripts/php/mysql_connect.php")?>
<?php

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
       	       	 returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Id is incorrect format', 'status'=> 406));
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
		$mysqli->close();
		header("HTTP/1.0 202 Accepted");
		exit();
				
       	    }
       	       
       }
       
  
       
   }
   
   //handle post ajax
   
   //get the user's submitted json 
   $json = file_get_contents('php://input');
   $obj = json_decode($json);

//checking for blog post
$post= $obj->{'post'};
$title= $obj->{'title'};

  if(isset($post) && isset($title)){ //means user is post to blog 
  
    //first confirm that the user is not muted (actually allowed to post)  
    
     if(strcasecmp('Root',$_SESSION["user"]->status()) != 0){ //post restrictions doesn't apply to ROOT user 
     	$ign = $_SESSION["user"]->name();
     	$result = $mysqli->query("select Mute from Users where Ign='$ign'");
        $priv = $result->fetch_assoc();
     	
        if($priv['Mute'] != 0 ){
        $result->close();
        $mysqli->close(); 	
        returnJSON("HTTP/1.0 401 Unauthorized", "");
        }
     	     
     }else $ign = "Root";
     
     $ign = $mysqli->real_escape_string($ign);
     $title = $mysqli->real_escape_string($title);
     $post = $mysqli->real_escape_string($post);
     
     
     //post to blog 
     if($mysqli->query("insert into Blog(Author,Title,Post,PublishDate) values('$ign','$title','$post',now())")){
     	   
     	  $mysqli->close(); 
     	  returnJSON("HTTP/1.0 202 Accepted",array('status'=>202));
     	     
     }else{
      	 $mysqli->close();   
         returnJSON("HTTP/1.0 503 Service Unavailable", array('msg'=>'We are having problems with the server at the moment','status'=>503));	     
     }
     
	  
    } 
    
//check for team creation
$team_name =$obj->{'name'};

   if(isset($team_name)){
	
    /* The user cannot create a team if he/she is 
       already part of a team of the team! Or if the
       user is the root user.
    */
    if($_SESSION['user']->hasTeam() || strcasecmp('Root',$_SESSION["user"]->status()) == 0) returnJSON("HTTP/1.0 401 Unauthorized", "");
    
    //check to see if the team name already exsists 
    $team_name = $mysqli->real_escape_string($team_name);
    $result = $mysqli->query("select TeamID from Teams where TeamName='$team_name'");
    $count = $result->num_rows;  
    $result->close();	
	//if count is zero that means no user exists
	if($count==0){
	//make sure that the name is not too long 
	    $length = strlen(trim($team_name));
	    if($length > 32 || $length == 0){
		    $mysqli->close();
		   returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Team name is too long or too short', 'status'=> 406));
	     }
	
        /*no conflicts so add to database. 
          Use a transtaction since we need 
          to insert into team and update the 
          user creating the team (also edit the user object in the session)
        */
       $mysql_error = false;
        //start transaction
        $mysqli->autocommit(false);
        
        //get user's id 
        $result = $mysqli->query("select UserID from Users where Ign='".$_SESSION['user']->name()."'");
        $array= $result->fetch_assoc();
        $user_id = $array['UserID'];
        $result->close();
        //insert team (and store id)
        if($mysqli->query("insert into Teams (UserID,TeamName) values('$user_id','$team_name')") === TRUE){
            $team_id = $mysqli->insert_id;
            if(!$mysqli->query("update Users set TeamID ='$team_id' where UserID='$user_id'") === TRUE)$mysql_error = true; 
        	
        	
        }else $mysql_error = true; 
        
        if($mysql_error){
          $mysqli->rollback();
          $mysqli->close();
          returnJSON("HTTP/1.0 503 Service Unavailable","");
        }else{
          $mysqli->commit(); 	
          $mysqli->close();	
          //point to new team in user object 
          $_SESSION['user']->setTeam($team_id);
          returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Team has been created','id'=>$team_id));
	
        }
		 
	 
		
	}else returnJSON("HTTP/1.0 409 Conflict",array('msg'=>'The Team name is already in use', 'status' => 409));

	
  }
  
//check to see if user is leaving a team, deleting a team mate or assigning some one as captain
$opt = $obj->{'opt'};//opperation 
  
 if(isset($opt)){
 	 
    switch($opt){
    	    
    case "leave":
    	$team_id = $obj->{'team'};  
    	if(!isset($team_id) || !is_numeric($team_id))returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Need to specify a team to leave from', 'status'=> 406));
    	//make sure that the current user is actuall on the team he is leaving 
    	if($team_id != $_SESSION['user']->team)returnJSON("HTTP/1.0 401 Unauthorized" ,array('msg'=>'Cannot leave a team you are not appart of..', 'status'=> 401));
    	//make sure team actually exsists 
    	$query = $mysqli->query("select TeamName from Teams where TeamID=$team_id");
    	if($query->num_rows == 0){
    	 $query->close();
    	 $mysqli->close();
    	 returnJSON("HTTP/1.0 404 Not Found" ,array('msg'=>'team not found ', 'status'=> 404));
    	}
    	$query->close();
    	//check to see if  this user is the captain of the team 
    	$result = $mysqli->query("select UserID from Users where Ign='".$_SESSION['user']->name()."' and UserID=(select UserID from Teams where TeamID='$team_id')");
    	//should get 1 row if user is captain of the team and 0 if the user is just a regular member
    	if($result->num_rows > 1) returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Error with query','status'=>503));
    	else if($result->num_rows == 1){//whole team must be deleted 
            //remove all user from team (use transaction)
	    $result->close();
	    $mysqli->autocommit(false);
	    
	    //notify all team mates that the team has been delete (and they have been booted)
	    $result = $mysqli->query("select UserID from Users where TeamID=$team_id and not UserID=(select UserID from Teams where TeamID=$team_id)");
	    $mysql_error = false;
	    while($row = $result->fetch_assoc()){
	      if(($mysqli->query("insert into Notifications (UserID,NoteType) values('".$row['UserID']."','td')"))=== FALSE)$mysql_error = true;
	    }
	    
	    //update all teamates (remove members)
	    if(!$mysql_error && $mysqli->query("update Users set TeamID = NULL where TeamID='$team_id'")){
	     
	    	 //delete any team requests and team request notifications 
	    	 if(($mysqli->query("delete from RequestDispatcher where TeamID=$team_id")) === TRUE){
	    	    $sub1 = "(select UserID from Teams where TeamID=$team_id)";
	    	    if(($mysqli->query("delete from Notifications where UserID=$sub1 and NoteType='tr'") ) === TRUE){
	    	    	    
	    	    	    //delete team 
			if($mysqli->query("delete from Teams where TeamID=$team_id")){
				
			  $mysqli->commit();
			  $mysqli->close();   
			  $_SESSION['user']->setTeam(null);
			   returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Team has been deleted'));
			}	     
	    	    	    
	    	    }
	    	 	 
	    	 }    	  
	    	
	    }
	      $mysqli->rollback();
	      $mysqli->close();
	       returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Error with update for team deletion','status'=>503));
	  }else{
	  	  
    	  if($mysqli->query("update Users set TeamID = NULL where Ign='".$_SESSION['user']->name()."'")){
	      $mysqli->close();  
	       $_SESSION['user']->setTeam(null);
	      returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'User has been removed from team'));
	    }else{
	      $mysqli->close();
	       returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Error with individual update','status'=>503));
	    }	
    	 	
    	}
    	
    	break;
    	
     case "join":
     $team_id = $obj->{'team'};  
     if(!isset($team_id) || !is_numeric($team_id))returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Need to specify a team to join', 'status'=> 406));
     //make sure current user is allowed to join a team 
     if($_SESSION['user']->hasTeam())returnJSON("HTTP/1.0 401 Unauthorized" ,array('msg'=>'You are already on a team', 'status'=> 401));
     //check to see if user has already made a request
     $query = $mysqli->query("select UserID from RequestDispatcher where UserID=(select UserID from Users where Ign='".$_SESSION['user']->name()."' and TeamID=$team_id)");
     if($query->num_rows != 0){
     $query->close();
     $mysqli->close(); 	     
     returnJSON("HTTP/1.0 401 Unauthorized" ,array('msg'=>'You have already requested to join this team', 'status'=> 401));
     }
     $query->close();
      //make a request (first find captain)
      $query = $mysqli->query("select UserID from Teams where TeamID=$team_id");
      $array = $query->fetch_assoc();
      $captain = $array['UserID'];
      $query->close();
      //start transaction 
       $mysqli->autocommit(false);
        //create a notification for the captain of the team 
       if($mysqli->query("insert into Notifications (NoteType,UserID) values('tr','$captain')") === TRUE){
       	       
       	   $note_id = $mysqli->insert_id;  
       	   //save notification in request dispatcher (get current user's id first)
       	   $query = $mysqli->query("select UserID from Users where Ign='".$_SESSION['user']->name()."'");
       	   $array = $query->fetch_assoc();
       	   $user_id = $array['UserID'];
       	   $query->close();
       	    
       	   if($mysqli->query("insert into RequestDispatcher(NoteID,UserID,TeamID) values('$note_id','$user_id','$team_id') ") === TRUE){
       	     
       	     $mysqli->commit();
       	     $mysqli->close();
       	     returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Join Team Request has been sent'));
       	   }
       }
       
       $mysqli->rollback();
       $mysqli->close();
       returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Error with update for team deletion','status'=>503));
       
    	    
    } 	 
 }

 //notification responses
 $note = $obj->{'note'};
 if(isset($note)){
    
   $id = $obj->{'id'};// id of the note 	 
   if( !isset($id) || !is_numeric($id))returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Not a valid id', 'status'=> 406));
   $query = $mysqli->query("select * from Notifications where NoteID=$id and Respond=0");
   if($query->num_rows == 0) returnJSON("HTTP/1.0 404 Not Found" ,array('msg'=>'note not found ', 'status'=> 404));
   //make sure that the notification belongs to the current user 	 
   $result = $query->fetch_assoc();
   $query->close();
   $query = $mysqli->query("select UserID from Users where Ign='".$_SESSION['user']->name()."' and UserID=".$result['UserID']);
   if($query->num_rows ==0)returnJSON("HTTP/1.0 401 Unauthorized" ,array('msg'=>'This is not your notification', 'status'=> 401)); 
   //now we can preform some operations 
   $query->close();
     $mysqli->autocommit(false);
   //-1 in note denotes delete notification 
   if($note == -1){
   	switch($result['NoteType']){
   	case 'a':
   	case 'd':
   		 // delete team request
   		if($mysqli->query("delete from RequestDispatcher where UserID=(select UserID from Users where Ign='".$_SESSION['user']->name()."') and TeamID=(select TeamID from ResponseDispatcher where NoteID=$id)")){
   		  //delete the notification accociated with the team join request 
   		  if($mysqli->query("delete from Notifications where UserID=(select UserID from Teams where TeamID=(select TeamID from ResponseDispatcher where NoteID=$id)) and Respond=1 and NoteType='tr'")){
   		  	  //delete the team response
   		      if($mysqli->query("delete from ResponseDispatcher where NoteID=$id")){
			    //delte the notification  
			     if($mysqli->query("delete from Notifications where NoteID=$id")){
				$mysqli->commit();
				$mysqli->close();
				returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Note delted!'));   
			     }
   		  	  
   		     } 
   		  }
   			
   		 
   		}
   	       
   		$mysqli->rollback();
   	        $mysqli->close();
   	        returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Failed to delete note','status'=>503));
   		break;
   	 case 'td':
   	 	 if($mysqli->query("delete from Notifications where NoteID=$id")){
   	 	 	$mysqli->commit();
			$mysqli->close();
			returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Note delted!'));    
   	 	 	 
   	 	 }else{
   	 	   $mysqli->rollback();
   	           $mysqli->close();
   	           returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Failed to delete note','status'=>503));
   	 	 }
   	 	 break;
   	 	 
   	 case 'tr':
   	 	 //delete team request 
   	 	 if($mysqli->query("delete from RequestDispatcher where NoteID=$id")){
   	 	     if($mysqli->query("delete from Notifications where NoteID=$id")){
   	 	 	$mysqli->commit();
			$mysqli->close();
			returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Note delted!'));    
   	 	 	 	 
   	 	     }
   	 	 }
   	 	  $mysqli->rollback();
   	           $mysqli->close();
   	           returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Failed to delete note','status'=>503));
   	 	 break;
   	}
   	   
   	   
   }
   
   // 1 or 0 in notes denoted a decision being made 
   
   switch($result['NoteType']){
   	   
   	 case 'tr'://responding to a join request 
   	 // $mysqli->autocommit(false);
   	  //get id of the recipiant 
   	  $query = $mysqli->query("select UserID from RequestDispatcher where NoteID=$id");
   	  
   	  $array = $query->fetch_assoc();
   	  $request_user = $array['UserID'];
   	 
   	 if($note == 1){//we accept the request 
   	   //create a note for requesting user	 
   	 	 if(($mysqli->query("insert into Notifications (NoteType,UserID) values('a',$request_user)")) == True){
   	    	$insert_note = $mysqli->insert_id;
   	        if(($mysqli->query("insert into ResponseDispatcher (NoteID,TeamID) values($insert_note, ".$_SESSION['user']->team.")")) === TRUE){
   	            //hide the notification 
   	            if(($mysqli->query("update Notifications set Respond = 1 where NoteID=$id")) === True){
   	            	    
   	            	$mysqli->commit();
   	        	$mysqli->close();
   	    	 	returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Join Team Request accepted'));  
   	            }
   	        	
   	    	 }
   	    	
   	    } 
   	 	 
   	 } else if ($note == 0){// we decline 
   	    //create notification for requesting user 
   	    if(($mysqli->query("insert into Notifications (NoteType,UserID) values('d',$request_user)")) == True){
   	    	$insert_note = $mysqli->insert_id;
   	        if(($mysqli->query("insert into ResponseDispatcher (NoteID,TeamID) values($insert_note, ".$_SESSION['user']->team.")")) === TRUE){
   	         //hide the notification 
   	            if(($mysqli->query("update Notifications set Respond = 1 where NoteID=$id")) === true){
   	        	  	            	    
   	            	   $mysqli->commit();
   	        	  $mysqli->close();
   	    	 	  returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Join Team Request Declined')); 	
   	             }
   	    	 }
   	    	
   	    }
   	 	 
   	 	 
   	 }else{//just doesn't make sense 
   	 
   	   $result->close();
   	   $mysqli->close();
   	   returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Not a valid note', 'status'=> 406));
   	 }
   	  $mysqli->rollback();
   	  $mysqli->close();
   	  returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Error with inserts','status'=>503));
   	
   	 	 break;
   	 	 
   	 case 'a'://responding to join request acceptance
   	  
   	 	 if($note == 1){// accept
   	 	  //check to see if there is room to be added on the team 
   	 	  $query = $mysqli->query("select count(UserID) as Count, TeamID from Users where TeamID=(select TeamID from ResponseDispatcher where NoteID=$id)");
   	 	  $result = $query->fetch_assoc();
   	 	  if($result["Count"] == 5){
   	 	    //delete team request because they cannot be added
   	 	   if($mysqli->query("delete from RequestDispatcher where UserID=(select UserID from Users where Ign='".$_SESSION['user']->name()."') and TeamID=(select TeamID from ResponseDispatcher where NoteID=$id)")){
   	 	   	 //delete notification associated with the team request   
   	 	   	 if($mysqli->query("delete from Notifications where UserID=(select UserID from Teams where TeamID=(select TeamID from ResponseDispatcher where NoteID=$id)) and Respond=1 and NoteType='tr'")){
   	 	   	 	 //delete the team response
   		                if($mysqli->query("delete from ResponseDispatcher where NoteID=$id")){
			        //delte the notification  
				     if($mysqli->query("delete from Notifications where NoteID=$id")){
				     	
					$mysqli->commit();
					$mysqli->close();
					 returnJSON("HTTP/1.0 203 Non-Authoritative Information",array('msg'=>'Team is full','status'=>203));  
				     }
   		  	  
   		                }  
   	 	   	 }
   	 	   }
                   
   	 	    $mysqli->close();	  
   	 	   returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Error with deletes','status'=>503));
   	 	  }
   	 	   $query->close();
   	 	   //add user to team 
   	 	 
   	 	   if($mysqli->query("update Users set TeamID=".$result['TeamID']." where Ign='".$_SESSION['user']->name()."'")){
   	 	   	    // delete team request
   		      if($mysqli->query("delete from RequestDispatcher where UserID=(select UserID from Users where Ign='".$_SESSION['user']->name()."') and TeamID=".$result['TeamID'])){
   		             //delete the notification accociated with the team join request 
   		           if($mysqli->query("delete from Notifications where UserID=(select UserID from Teams where TeamID=(select TeamID from ResponseDispatcher where NoteID=$id)) and Respond=1 and NoteType='tr'")){
   		  	          //delete the team response
   		                if($mysqli->query("delete from ResponseDispatcher where NoteID=$id")){
			        //delte the notification  
				     if($mysqli->query("delete from Notifications where NoteID=$id")){
				     	//add team to user object in session 
				     	$_SESSION['user']->setTeam($result['TeamID']);
				     	     
					$mysqli->commit();
					$mysqli->close();
					returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Added to team!!'));   
				     }
   		  	  
   		                } 
   		            }
   			
   		 
   		        }
   	 	   	   
   	 	   }
   	 	  
   	 	  
   	 	 }else if($note == 0){
   	 	   //delete team request
   	 	   if($mysqli->query("delete from RequestDispatcher where UserID=(select UserID from Users where Ign='".$_SESSION['user']->name()."') and TeamID=(select TeamID from ResponseDispatcher where NoteID=$id)")){
   	 	   	 //delete notification associated with the team request   
   	 	   	 if($mysqli->query("delete from Notifications where UserID=(select UserID from Teams where TeamID=(select TeamID from ResponseDispatcher where NoteID=$id)) and Respond=1 and NoteType='tr'")){
   	 	   	 	 //delete the team response
   		                if($mysqli->query("delete from ResponseDispatcher where NoteID=$id")){
			        //delte the notification  
				     if($mysqli->query("delete from Notifications where NoteID=$id")){
				     
					$mysqli->commit();
					$mysqli->close();
					returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Declined team join'));   
				     }
   		  	  
   		                }  
   	 	   	 }
   	 	   }
   	 	 
   	 	 	 
   	 	 }else{
   	 	   $mysqli->close();
   	           returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Not a valid note', 'status'=> 406));	 
   	 	 }
   	 	 
   	  $mysqli->rollback();
   	  $mysqli->close();
   	  returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Error with deletes','status'=>503));
   	
   	 	 break;
   	   
   }
 }

   
?>

<?php

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

