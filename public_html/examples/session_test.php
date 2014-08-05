<?php session_start(); 

$_SESSION['test'] = "Tesdfsdfsdfsdsdf";

?>
<html>
	<head>
		<title> Session</title>
	</head>
	<body style='text-align:center;'>
		
          
	  <?php 
                /*not that if session_start() is 
                 not called at the begining this
                  echo statement would not work as 
                   expected */
                echo $_SESSION["test"]; 



           ?>


	
	</body>
</html>
