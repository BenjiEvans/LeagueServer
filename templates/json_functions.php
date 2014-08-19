<?php
 function returnJSON($header,$JSONstring){
        	
         header($header);
         header('Content-type: application/json');
	 exit(json_encode($JSONstring));
        
        }
?>
