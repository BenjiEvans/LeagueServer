<?php
        // The code below creates the class
        class Team {
            // Creating some properties (variables tied to an object)
            public $id ;            
            public $win;
            public $losses;
	    public $captain;
	    public $name;
            
            // Assigning the values
            public function __construct($id,$name,$win,$losses,$captain, $status, $rank) {
              $this->id = $id;              
              $this->win = $win;
	      $this->losses = $losses;
              $this->captain = $captain;  
              $this->name = $name;
            }
          }
          
        
?>
