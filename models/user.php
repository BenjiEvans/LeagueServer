<?php
        // The code below creates the class
        class User {
            // Creating some properties (variables tied to an object)
            public $win;
            public $loss;
	    public $ign;
	    public $status;
			
            
            // Assigning the values
            public function __construct($ign,$win,$loss,$status) {        
              $this->win = $win;
	      $this->loss = $loss;
	      $this->ign= $ign;
	      $this->status = $status;
            }
            
            public function name(){
              return $this->ign;	    
            }
            
            public function status(){
               return $this->status;	    
            }
            
          }
?>
