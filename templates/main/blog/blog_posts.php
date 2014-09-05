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
 
$query = mysql_query("select * from Blog where Flagged != 1 order by BlogID desc limit 10");

                $count = mysql_num_rows($query);
                if($count == 0) echo "No Blog Posts";
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
                }

          
                
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
