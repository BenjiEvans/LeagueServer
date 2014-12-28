<?php

function addTeam($team_name, $captain){

global $mysqli;

 $mysqli->autocommit(false);
 if($mysqli->query("insert into Teams (name,captain) values('$team_name',$captain)")){

	if($mysqli->query("update Users set team='$team_name' where id=$captain")){
		 $mysqli->commit(); 	
		return true;
	
	}


  }

$mysqli->rollback();
return false;

}

function is_captain($id, $team){

global $mysqli;

  $query = $mysqli->query("select captain from Teams where name='$team'");
  $row = $query->fetch_assoc();
  $result = $row['captain'] == $id;
  $query->close();

  return $result;
}

function remove_all_members($team){
global $mysqli;
  $query = $mysqli->query("select id from Users where team='$team'");
  $q2 = $mysqli->query("select captain from Teams where name='$team'");
  $r = $q2->fetch_assoc();
  $captain = $r['captain'];
  $mysqli->autocommit(false);

  //remove members and notify them 
  while($row = $query->fetch_assoc()){
    
    if(!remove_from_team($row['id'])){

         $mysqli->rollback();
	 return false;
     }
    //don't notify captain of the team 
    if($row['id'] == $captain) continue;

    if(!notify_leave($row['id'],$captain)){

	 $mysqli->rollback();
	 return false;

     }
	

  }

  $query->close();
  //delete team 
  if(!$mysqli->query("delete from Teams where name='$team'")){
	
	 $mysqli->rollback();
	 return false;  
   }
   
  //delete all team request notifications 
  if(!delete_join_requests($captain)){
	 $mysqli->rollback();
	 return false;  
  }


  $mysqli->commit();

return true;
}

function remove_from_team($id){

global $mysqli;

return $mysqli->query("update Users set team=NULL where id=$id");


}

function notify_leave($to, $from){

return send_note($to, $from, 0);

}

function team_exsists($team_name){
global $mysqli;
$query = $mysqli->query("select name from Teams where name='$team_name'");
$result = $query->num_rows == 1;
$query->close();
return $result;

}

function notify_join_request($to, $from){

return send_note($to,$from,1);
}

function delete_join_requests($captain){
//deleted any join request to the captain
global $mysqli;

return $mysqli->query("delete from Notes where recipient='$captain' and type=1");
}

function send_note($to,$from,$type){
global $mysqli;

return $mysqli->query("insert into Notes (sender,recipient,type) values('$from','$to', $type)");


}

function note_belongs_to($nid, $owner){

//TODO
return true;


}

function handle_note_response($nid, $response){

 
 //team should be globally defined 
 //global $team;
 global $mysqli;

 $query = $mysqli->query("select sender,recipient,type from Notes where nid=$nid");
 $note = $query->fetch_assoc();
 $query->close();
 switch($note['type']){
  
  case 1://join request 
    // if(is_null($team))return false;//if user has a team 
     if($response){
          if(notify_join_accept($note['sender'],$note['recipient']) && delete_note($nid)) return true;
	  else return false;
      }else{
	  if(notify_join_decline($note['sender'],$note['recipient']) && delete_note($nid)) return true;
	  else return false;
      }
    break;

  case 2://accept join 
    if($response){
        $team = get_team_by_captain($note['sender']);
        // id should be globally defined
        global $id;
	if(add_to_team($id,$team) && delete_note($nid)) return true;
	else return false;
     }else{
	if(delete_note($nid)) return true;
	else return false;
    }
  break;
 }

//this should actually be true. switched as false or debugging 
return false;

}

function add_to_team($member,$team){
//make sure team is not full before adding to team 
global $mysqli;

$query = $mysqli->query("select count(*) as total from Users where team='$team'");
$row = $query->fetch_assoc();
$query->close();

if($row['total'] == 5) return false;

return $mysqli->query("update Users set team='$team' where id=$member");


}

function notify_join_accept($to,$from){
return send_note($to,$from,2);
}

function notify_join_decline($to, $from){
return send_note($to, $from,3);
}


function delete_note($nid){
global $mysqli;
return $mysqli->query("delete from Notes where nid=$nid");

}

function get_team_by_captain($captain){

global $mysqli;

$query = $mysqli->query("select name from Teams where captain=$captain");
$row = $query->fetch_assoc();
$query->close();

return $row['name'];

}

function has_team($id,$team){

global $mysqli;

$query = $mysqli->query("select ign from Users where id=$id and team='$team'");
$row = $query->num_rows;
$query->close();

return $row == 1;

}


function assign_as_captain($id,$team){
global $mysqli;
return $mysqli->query("update Teams set captain=$id where name='$team'");


}

function notify_ban($to,$from){

return send_note($to,$from,4);

}


function notify_new_captain($to, $from){

return send_note($to,$from,5);

}




?>
