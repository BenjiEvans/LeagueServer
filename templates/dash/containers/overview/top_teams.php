 <h1 class="page-header">Top Teams</h1>

<div class="row placeholders">

<?php

 $query = $mysqli->query("select name from Teams limit 4");
                $count = $query->num_rows;
                if($count == 0) echo "<h2><em>No Ranked Teams</em></h2>";
                else{
                              
                   $i = 1;
                  while ($row = $query->fetch_assoc()) 
                  {                	  
                    echo "<div class='ol-xs-6 col-sm-3 placeholder'>";
                    echo "<img data-src='holder.js/200x200/auto/sky' class='featurette-image img-responsive' alt='Generic placeholder thumbnail'>";
                   // echo '<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">';
                    echo "<h4>".$row['name']."</h4>";
                    echo "<span class='text-muted'>$i</span>";
                    echo " </div>";
                     $i+=1;
                  }
                  
                  $query->close();
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
