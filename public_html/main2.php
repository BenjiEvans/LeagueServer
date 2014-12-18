<?php require("../scripts/php/login_check.php") ?>
<?php require("../scripts/php/json_functions.php")?>
<?php require("../scripts/php/mysql_connect.php")?>
<?php require("../scripts/php/user_info.php")?>
<?php

   //handle post ajax
   
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
      returnJSON("HTTP/1.0 503 Service Unavailable", array('msg'=>'We are having problems with the server at the moment','status'=>503));	     
     
     
	  
    } 


   
?>

