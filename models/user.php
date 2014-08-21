

      <?php
        // The code below creates the class
        class User {
            // Creating some properties (variables tied to an object)
            public $id ;
            public $win;
            public $losses;
			public $email;
			
            
            // Assigning the values
            public function __construct($id,$win,$losses,$email) {
              $this->id = $id;              
              $this->win = $win;
			  $this->losses = $losses;
			  $this->email = $email;			  
            }
          }
        ?>
