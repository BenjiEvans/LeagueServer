 <h1 class="page-header overview">Top Teams</h1>

<div class="row placeholders overview">

<?php

 $query = mysql_query("select TeamName from Teams where Score is not null order by Score desc limit 4");
                $count = mysql_num_rows($query);
                if($count == 0) echo "No Ranked Teams";
                else{
                              
                   $i = 1;
                  while ($row = mysql_fetch_array($query)) 
                  {                	  
                    echo "<div class='ol-xs-6 col-sm-3 placeholder'>";
                    echo "<img data-src='holder.js/200x200/auto/sky' class='img-responsive' alt='Generic placeholder thumbnail'>";
                    echo "<h4>".$row['TeamName']."</h4>";
                    echo "<span class='text-muted'>$i</span>";
                    echo " </div>";
                     $i+=1;
                  }
                }




?>

              
           
           <!-- <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Team Name</h4>
              <span class="text-muted">2</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Team Name</h4>
              <span class="text-muted">3</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Team Name</h4>
              <span class="text-muted">4</span>
            </div> -->
</div>