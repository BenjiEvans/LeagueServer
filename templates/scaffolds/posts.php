<?php 
	require("../scripts/php/post_functions.php");
     $query = $mysqli->query("select * from Posts order by pid desc limit 10");
     $count = $query->num_rows;
                if($count == 0) echo "No Blog Posts";
                else{
                  while ($row = $query->fetch_assoc()) 
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
                    echo "<p>".htmlspecialchars($row['message'])."</p>";
                    echo "</div>";
                  }
                  $query->close();
                }
 ?>
