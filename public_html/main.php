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
       
       if($param == 'blog' ){
       	
       	       if(isset($_GET['id'])){
       	          
       	       	$id = $_GET['id'];   
       	       	$limit = 10; 
       	       	$query = mysql_query("select * from Blog where Flagged != 1 and BlogID < $id order by BlogID desc limit $limit");

                $count = mysql_num_rows($query);
                if($count == 0) echo "";
                else{
               
                  while ($row = mysql_fetch_array($query)) 
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
		 
	 returnJSON("HTTP/1.0 202 Accepted",array('status'=>202,'author'=> $ign));
	  
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

