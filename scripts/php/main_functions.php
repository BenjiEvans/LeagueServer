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
//TODO
global $mysqli;
  $query = $mysqli->query("select id from Users where team='$team'");
  $mysqli->autocommit(false);

  //remove members and notify them 
  while($row = $query->fetch_assoc()){
    
    if(!remove_from_team($row['id'])){

         $mysqli->rollback();
	 return false;
     }

    if(!notify_leave($row['id'])){

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

  $mysqli->commit();

return true;
}

function remove_from_team($id){

global $mysqli;

return $mysqli->query("update Users set team=NULL where id=$id");


}

function notify_leave($id){
//TODO
return true;
}





?>
