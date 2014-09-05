<?php require("../models/user.php") ?>
<?php require("../scripts/php/login_check.php") ?>
<?php require("../scripts/php/json_functions.php")?>
<?php require("../scripts/php/mysql_connect.php")?>
<?php

   if(isset($_GET['rq'])){
   	   
       $param = $_GET['rq'];
             
       if($param == 'logout'){
   	   
   	   	   unset($_SESSION["user"]);
   	   	   header("Location: /index.php");
   	   	   exit();
       }
       
  
       
   }
   
   //hand post ajax
   
   //get the user's submitted json 
   $json = file_get_contents('php://input');
   $obj = json_decode($json);

//checking for blog post
$post= $obj->{'post'};
$title= $obj->{'title'};

  if(isset($post) && isset($title)){ //means user is post to blog 
  
    //first confirm that the user is not muted (actually allowed to post)  
    
     if(strcmp('Root',$_SESSION["user"]->status()) != 0){ //post restrictions doesn't apply to ROOT user 
     	$ign = $_SESSION["user"]->name();
     	$query = mysql_query("select Mute from Users where Ign='$ign'");
        $priv =mysql_fetch_assoc($query);
     	
        if($priv['Mute'] != 0 ) returnJSON("HTTP/1.0 401 Unauthorized", "");
     	     
     }else $ign = "Root";
     
     //post to blog 
      $insert = mysql_query("insert into Blog(Author,Title,Post,PublishDate) values('$ign','$title','$post',now())"); 
       
	
        if($insert === false){
      	      
      	   // print mysql_error();
	    returnJSON("HTTP/1.0 503 Service Unavailable", array('msg'=>'We are having problems with the server at the moment'.mysql_error(),'status'=>503));
	}
		 
	 returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'msg'=> 'Post has been added to our database'));
	  
    }

   
?>


