<?php
        // The code below creates the class
        class User {
            // Creating some properties (variables tied to an object)
            public $win;
            public $loss;
	    public $ign;
			
            
            // Assigning the values
            public function __construct($ign,$win,$loss) {        
              $this->win = $win;
	      $this->loss = $loss;
	      $this->ign= $ign;
            }
            
            public function name(){
              return $this->ign;	    
            }
          }
?>
