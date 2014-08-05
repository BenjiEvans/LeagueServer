<?php
   /*session start should always 
    * be the first thing called if sessions 
    * are being used */
   session_start();

   define("USER","root");//defines a constant variable named USER with the value "root"
   define("PASS","password");// defines another constant variable named PASS with the value "password"
  
  if(isset($_POST["user"]) && isset($_POST["pass"])){ // then we validate 
		
         //check if user name and password are correct 
	if($_POST["user"] == USER && $_POST["pass"] == PASS)
	{
		$_SESSION["name"] = $_POST["user"];
              
		header('Location: ./user.php');//redirect to user.php
		exit;
	}
	


   }


header( 'Location: ./index.html' ); //redirect back to index.html

?>
