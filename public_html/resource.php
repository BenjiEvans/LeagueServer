<?php 
require("../scripts/php/login_check.php");
require("../scripts/php/mysql_connect.php");
require("../scripts/php/user_info.php");
require("../scripts/php/post_functions.php");
require("../scripts/php/resource_functions.php");
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
       	          
       	       	$ide = $_GET['id'];  
	       	       	if(!is_numeric($ide)){//id must be a number other wise exceptions will occur 
	       	         		
	       	       	  $mysqli->close();	
	       	       	 header("HTTP/1.0 406 Not Acceptable");
	       	       	 exit();
	       	       	}
       	       	$limit = 10; 
                $result = $mysqli->query("select * from Posts where pid < $ide order by pid desc limit $limit");
                $count = $result->num_rows;
		        if($count == 0) echo "";
		        else{
		       
		          while ($row = $result->fetch_assoc()) 
		          {                	  
		            echo "<div class='blog-post' id='".$row['pid']."'>";
		            echo "<h2 class='blog-post-title'>".$row['title']."</h2>";
		            
		            $date = explode("-",$row['post_date']);
		            //break date into month,day,and year
		            $y = $date[0];
		            $m = getMonth($date[1]);
		            $d = $date[2];
		            
		            echo "<p class='blog-post-meta'> $m $d, $y by ";
		            echo "<a href='#'>".getIgnByID($row['author'])."</a></p>";
		            echo "<p>".$row['message']."</p>";
		            echo "</div>";
		    
		          }
		         
		        }
       	       }
       	       $result->close();
       	       $mysqli->close();       	 
       	       exit();    
       }
       
       if($param == 'team_list'){// get team listing 
        require("../templates/scaffolds/team_list.php");
       	  exit();
       }
       
       if($param == 'team'){//view team's profile
       	  if(isset($_GET['name'])){  
       	       	$name = $_GET['name']; //team's id 
       	       	//get the team specified 
       	       	$query = $mysqli->query("select * from Teams where name='$name'");
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
		 print_team_profile($name);	
       	    }
       	       
       }
   }
?>




