<?php session_start();?>
<?php require("../templates/mysql_connect.php")?>
<?php require("../templates/json_functions.php")?>

      <?php
        // The code below creates the class
        class User {
            // Creating some properties (variables tied to an object)
            public $key ;
            public $ign;
            public $win;
            public $losses;
			public $team_id;
			public $prev_team;
			public $email;
			public $password;
			public $salt;
			public $activate =False;
			public $register;
			public $status={'Collegiate','Challenger','Admin','Root'};
			public $rank ;
            
            // Assigning the values
            public function __construct($key, $ign, $win,$losses, $team_id, $prev_team,$email, $password, $salt,$activate,$register, $status, $rank) {
              $this->key = $key;
              $this->ign = $ign;
              $this->win = $win;
			  $this->losses = $losses;
			  $this->team_id = $team_id;
			  $this->prev_team = $prev_team;
			  $this->email = $email;
			  $this->password = $password;
			  $this->salt = $salt;
			  $this->activate = $activate;
			  $this->register = $register;
			  $this->status = $status;
			  $this->rank = $rank;
            }
            
            
          }
          
        // Creating a new user 
        $user = new User('boring', '12345', 12345);
        
        
        ?>
