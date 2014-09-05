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
 
$query = mysql_query("select * from Blog where Flagged != 1 order by PublishDate limit 10");

                $count = mysql_num_rows($query);
                if($count == 0) echo "No Blog Posts";
                else{
               
                  while ($row = mysql_fetch_array($query)) 
                  {                	  
                    echo "<div class='blog-post' id='".$row['BlogID']."'>";
                    echo "<h2 class='blog-post-title'>".$row['Title']."</h2>";
                    echo "<p class='blog-post-meta'>".$row['PublishDate']."<a href='#'>".$row['Author']."</a></p>";
                    echo "<p>".$row['Post']."</p>";
                    echo " </div>";
            
                  }
                }




?>
