<?php require("../scripts/php/login_check.php"); ?>
<?php require("../scripts/php/mysql_connect.php"); ?>
<?php require("../scripts/php/user_info.php"); ?>
<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><meta name="author" content=""><link rel="icon" href="../../favicon.ico"><title>CSULA League of Legends Club</title><link href="./css/bootstrap/bootstrap.min.css" rel="stylesheet"><link href="./css/custom/layout.css" rel="stylesheet"><link href="./css/custom/dashboard.css" rel="stylesheet">
<style>
     .win{
     	    background-color:rgb(0,255,0);
     	    color:rgb(0,0,0);
        }
        
     .loss{
     	     
     	    background-color:rgb(255,0,0); 
     	    color:rgb(0,0,0);
     }
     
     a{
     	     
     	color:rgb(0,0,0);
     }
</style><script src="./js/bootstrap/ie-emulation-modes-warning.js"></script><script src="./js/bootstrap/ie10-viewport-bug-workaround.js"></script></head><body style='background-image:url("../img/background.jpg");background-attachment: fixed;'>
  <?php //store user's info in hidddn form element
     echo "<input type='hidden' id='user' name='$ign'/>";  
  ?>
  
    <?php 
	require("../templates/dash/top_nav.php"); 
    ?>
<div class="container-fluid"><div class="row"><?php 
require("../templates/dash/side_nav.php"); 
?><div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id='main_container' style='background-color:rgba(255,255,255,.7)'>
<?php if($status == 1)require("../templates/dash/containers/overview/overview.php"); ?>  
<?php require("../templates/dash/containers/blog/blog.php"); ?>  
<?php require("../templates/dash/containers/teams/team.php"); ?>
<div class='search' hidden></div>
<?php require("../templates/dash/containers/notes/note.php"); ?>                   
</div></div></div> 
<?php require("../templates/dash/modals/post.php"); ?> 
<?php 
       
	require("../templates/dash/modals/team_decide.php");
        require("../templates/dash/modals/create_team.php");
     ?>
<script src='./js/jquery/jquery.min.js'></script><script src="./js/bootstrap/bootstrap.min.js"></script><script src="./js/custom/docs.min.js"></script><script src="./js/custom/dashboard.js"></script></body></html>
