<?php
    require("../scripts/php/mysql_connect.php");
    require("../scripts/php/post_functions.php");

  if($_GET['rq'] == 'blog' ){// get next blog posts 
       	
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
                  
                  //if($count < $limit) echo file_get_contents("../templates/main/blog/blog_footer.php");
                }
       	       }
       	       $result->close();
       	       $mysqli->close();       	 
       	       exit();    
       }



?>