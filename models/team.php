<?php session_start();?>
<?php require("../templates/mysql_connect.php")?>
<?php require("../templates/json_functions.php")?>

      <?php
        // The code below creates the class
        class Team {
            // Creating some properties (variables tied to an object)
            public $id ;            
            public $win;
            public $losses;
			public $captain;
			public $status={'Collegiate','Challenger'};
			public $rank ;
            
            // Assigning the values
            public function __construct($id,$win,$losses,$captain, $status, $rank) {
              $this->id = $key;              
              $this->win = $win;
			  $this->losses = $losses;
			  $this->captain = $captain;
			  $this->status = $status;
			  $this->rank = $rank;
            }
          }
          
        // Creating a new user 
        $team = new Team('boring', '12345', 12345);
		
        ?>
