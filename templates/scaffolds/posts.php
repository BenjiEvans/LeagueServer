<!-- <div class="blog-post">
            <h2 class="blog-post-title">Hello World!</h2>
            <p class="blog-post-meta">May 18, 2014 by <a href="#">Benji</a></p>
			
			<p> 
				It took a while but here we are! With over 180 members (and counting),
				our club now has an official website :D. From this page you can link to the 
				Schools webiste or the League of Legends site (by clicking on the images in the navigation Bar) and can also 
				link to our facebook page and twitch stream (links should be on the right... might have to scroll?). The website is 
				still under construction so stay tuned for more interesting content.
				
			</p>
          
  </div><!-- /.blog-post -->

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
