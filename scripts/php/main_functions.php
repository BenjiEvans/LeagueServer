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
//TODO
return true;
}

function team_exsists($team_name){
//TODO

return true;

}

function notify_join_request($to, $from){
//TODO
return true;
}

function delete_join_requests($captain){
//TODO

return true;
}





?>
