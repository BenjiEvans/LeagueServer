 <!--<h1 class="page-header">Teams</h1> -->

<!--<div class="row placeholders"> -->

<?php

 $query = $mysqli->query("select name, captain from Teams");
                $count = $query->num_rows;
                if($count == 0) echo "<h2><em>No Teams</em></h2>";
                else{
                    
		  while($team_row = $query->fetch_assoc()){//get the teams
		         //echo "<table class='table' style='border:solid;float:left;margin-right:10px;margin-bottom:10px; width:40%;'>";
			 echo "<table class='table table-bordered' style='width:40%;float:left;margin-right:10px;margin-bottom:10px;'>";
			 echo "<thead><tr><th>".$team_row['name']."</th></tr></thead><tbody>";

			$mem_query = $mysqli->query("select ign, id from Users where team='".$team_row['name']."'");
			while($mem_row = $mem_query->fetch_assoc()){ //get each member of the team 
				
			   echo "<tr";
			   if($mem_row['id'] == $team_row['captain']) echo " class='info'";
			   echo "><td>";
			   echo $mem_row['ign'];
			   echo "</td></tr>";

			}
			echo "</tbody></table>";
			$mem_query->close();
		  }        
                  
                }

		$query->close();


?>


<?php 
/*
 for($i = 0; $i < 100; $i++){
   echo "<table class='table' style='border:solid;float:left;margin-right:10px;margin-bottom:10px; width:40%;'>

<thead>
 <tr><th>Team Name</th></tr>
</thead>
<tbody>
	<tr><td>player1</td> </tr>
	<tr><td>player2</td> </tr>
	<tr><td>player3</td> </tr>
</tbody>

</table>";

  } */


?>
<!--<table style='border:solid;float:left'>

<thead>
 <tr><th>Team Name</th></tr>
</thead>
<tbody>
	<tr><td>player1</td> </tr>
	<tr><td>player2</td> </tr>
	<tr><td>player3</td> </tr>
</tbody>

</table> -->


    
           
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
<!-- </div> -->
