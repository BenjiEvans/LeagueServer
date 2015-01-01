<?php require("../scripts/php/login_check.php") ?>
<?php require("../scripts/php/json_functions.php")?>
<?php require("../scripts/php/mysql_connect.php")?>
<?php require("../scripts/php/user_info.php")?>
<?php require("../scripts/php/main_functions.php")?>
<?php
   //get the user's submitted json 
   $json = file_get_contents('php://input');
   $obj = json_decode($json);
//checking for blog post
$post= $obj->{'post'};
$title= $obj->{'title'};
  if(isset($post) && isset($title)){ //means user is post to blog 
    //confirm that user is authorized to post 
    if($status != 1)returnJSON("HTTP/1.0 401 Unauthorized", "");
     $title = $mysqli->real_escape_string($title);
     $post = $mysqli->real_escape_string($post);
     //post to blog 
     if($mysqli->query("insert into Posts(message,title,author,post_date) values('$post','$title',$id,now())")){
     	  $mysqli->close(); 
     	  returnJSON("HTTP/1.0 202 Accepted",array('status'=>202)); 
     }
      $mysqli->close();   
      returnJSON("HTTP/1.0 503 Service Unavailable", array('msg'=>'We are having problems with the server at the 	moment','status'=>503));	     
    } 
//check for team creation
$team_name =$obj->{'name'};
 if(isset($team_name)){
	
    /* The user cannot create a team if he/she is 
       already part of a team of the team! 
    */
    if(!is_null($team)){
	$mysqli->close();
	 returnJSON("HTTP/1.0 401 Unauthorized", "");
     }
    
    //check to see if the team name already exsists 
    $team_name = $mysqli->real_escape_string($team_name);
    $result = $mysqli->query("select name from Teams where name='$team_name'");
    $count = $result->num_rows;  
    $result->close();	
	//if count is zero that means no team exists
	if($count != 0){
		
             $mysqli->close();
	     returnJSON("HTTP/1.0 409 Conflict",array('msg'=>'The Team name is already in use', 'status' => 409));
	}

	//make sure that the name is not too long 
	$length = strlen(trim($team_name));
	if($length > 32 || $length == 0){
	     $mysqli->close();
	     returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Team name is too long or too short', 'status'=> 406));
	 }
	
        /*no conflicts so add to database. */
	$success = addTeam($team_name,$id);
	if($success){
	    $mysqli->close();
	    returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Team has been created','id'=>$team_name));    
	}else{
	    $mysqli->close();
	    returnJSON("HTTP/1.0 503 Service Unavailable","");
	}
  }

//check to see if user is leaving a team, deleting a team mate or assigning some one as captain
$opt = $obj->{'opt'};
 if(isset($opt)){

	switch($opt){

	   case "leave":
	  //make sure user has a team to leave from 
		if(is_null($team))returnJSON("HTTP/1.0 401 Unauthorized" ,array('msg'=>'Cannot leave a team you are not appart of..', 'status'=> 401));
	     leave();
	   break;

	   case "join":
	   $join_team = $obj->{'id'};
	   if(!isset($join_team)){
	      $mysqli->close();
	      returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Team name must be send', 'status'=> 406));	
	   }
	   if(team_exsists($join_team)) request_join($join_team);
	    $mysqli->close();
	    returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'The team you are trying to join does not exsist','status'=>503));
	   break;

	  case "remove":
	  $iden = $obj->{'id'};
	   if(!isset($iden) || is_int($iden)){
	      $mysqli->close();
	      returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'not a valid id', 'status'=> 406));	
	   }

	   if(is_captain($id,$team) && has_team($iden,$team) && remove_from_team($iden) && notify_ban($iden, $id)){
		$mysqli->close();
	        returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'successfully removed member'));
	   }
	   
	   $mysqli->close();
	    returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'could not remove teammate','status'=>503));          

	  break;
	  case "captain":
		 $iden = $obj->{'id'};
	   if(!isset($iden) || is_int($iden)){
	      $mysqli->close();
	      returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'not a valid id', 'status'=> 406));	
	   }
	   if(is_captain($id,$team) && has_team($iden,$team) && assign_as_captain($iden,$team) && notify_new_captain($iden, $id)){
		$mysqli->close();
	        returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'successfully made member captain'));
	   }
	   $mysqli->close();
	    returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'could not remove teammate','status'=>503));          
	   break;
	}
 }

 //notification responses
 $note = $obj->{'note'};
 if(isset($note)){

   $nid = $obj->{'id'};// id of the note 	
   if( !isset($nid) || !is_numeric($nid))returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Not a valid id', 'status'=> 406));
	
   if(!note_belongs_to($nid,$id)) returnJSON("HTTP/1.0 401 Unauthorized" ,array('msg'=>'This is not your notification', 'status'=> 401)); 
   
   switch($note){
    
    case 0:
        if(handle_note_response($nid,false)){
		$mysqli->close();
              returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Note successfully handled!'));
	}
       
     break;
    case 1:
        if(handle_note_response($nid,true)){
             $mysqli->close();
        returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Note successfully handled!'));
        }
	
     break;
    case -1:
     if(delete_note($nid)){
       $mysqli->close();
       returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Not succesfully deleted!'));   
     }
     break;
   }

   $mysqli->close();
   returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Error handling notes','status'=>503));
 }
?>

<?php

function leave(){
global $mysqli;
global $id;
global $team;
// remove all member if user is captain 
	   if(is_captain($id,$team)){
		remove_all_members($team);
		$mysqli->close();
		returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'You have successfully left'));
	    }
	   //other wise just remove the individual user 
	    if(remove_from_team($id)){
	       $mysqli->close();
		returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'You have successfully left'));
	     }
	      $mysqli->close();
	       returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Could not remove from team','status'=>503));
}

function request_join($team_to_join){
  //send notifications to team captain 
  global $mysqli;
  global $id;
  $query = $mysqli->query("select captain from Teams where name='$team_to_join'");
  $result = $query->fetch_assoc();
  $captain = $result['captain'];
  if(notify_join_request($captain,$id)){
	 $mysqli->close();
	 returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Your request has been sent'));
   }
    $mysqli->close();
    returnJSON("HTTP/1.0 503 Service Unavailable",array('msg'=>'Could not send request to team','status'=>503));
}
?>


