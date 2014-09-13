<?php require("../models/user.php") ?>
<?php require("../scripts/php/login_check.php") ?>
<?php require("../scripts/php/json_functions.php")?>
<?php require("../scripts/php/mysql_connect.php")?>
<?php

   if(isset($_GET['rq'])){
   	   
       $param = $_GET['rq'];
             
       if($param == 'logout'){
   	   
   	   	   unset($_SESSION["user"]);
   	   	   $mysqli->close();
   	   	   header("Location: /index.php");
   	   	   exit();
       }
       
       if($param == 'blog' ){
       	
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
       
       if($param == 'team_list'){
       	       
       	require("../templates/login/dash/team_rank/team_list.php");
       	  exit();
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
     
     //post to blog 
     if($mysqli->query("insert into Blog(Author,Title,Post,PublishDate) values('".mysqli_real_escape_string($ign)."','".mysqli_real_escape_string($title)."','".mysqli_real_escape_string($post)."',now())")){
     	   
     	  $mysqli->close(); 
     	  returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'author'=> $ign));
     	     
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
	    if(strlen($team_name) > 32){
		    $mysqli->close();
		   returnJSON("HTTP/1.0 406 Not Acceptable" ,array('msg'=>'Team name is too long', 'status'=> 406));
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
          returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Team has been created'));
	
        }
		 
	 
		
	}else returnJSON("HTTP/1.0 409 Conflict",array('msg'=>'The Team name is already in use', 'status' => 409));

	
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

