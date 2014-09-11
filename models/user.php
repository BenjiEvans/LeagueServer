<?php
        // The code below creates the class
        class User {
            // Creating some properties (variables tied to an object)
            public $win;
            public $loss;
	    public $ign;
	    public $status;
	    public $score;
	    public $team;
	  
			
            
            // Assigning the values
            public function __construct($ign,$win,$loss,$status,$team) {        
              $this->win = $win;
	      $this->loss = $loss;
	      $this->ign= $ign;
	      $this->status = $status;
	      $this->score = $win-($loss*($loss/($win+$loss)));
	      $this->team = $team;
            }
            
            public function name(){
              return $this->ign;	    
            }
            
            public function status(){
               return $this->status;	    
            }
            
            public function wins(){
               return $this->win;	    
            }
            
            public function losses(){
               return $this->loss;	    
            }
            
            public function score(){
               return $this->score;	    
            }
            
            public function hasTeam(){
               return !empty($this->team);    
            }
            
                       
          }
?>
