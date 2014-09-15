<?php require("../models/user.php"); /* needs user model definition before session can start*/?>
<?php require("../scripts/php/login_check.php"); ?>
<?php require("../scripts/php/mysql_connect.php"); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
 
    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap/bootstrap.min.css" rel="stylesheet">

     <!-- styling for blog -->
    <link href="./css/custom/layout.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="./css/custom/dashboard.css" rel="stylesheet">
    
   
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
      
     
     
     </style>
     
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/bootstrap/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/bootstrap/ie10-viewport-bug-workaround.js"></script>
      
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style='background-image:url("../img/background.jpg");background-attachment: fixed;'>
  <?php //store user's info in hidddn form element
    echo "<input hidden id='user' name='".$_SESSION['user']->name()."' />";  
  ?>
  
    <?php require("../templates/login/dash/top_nav.php"); ?>
    
    <div class="container-fluid">
      <div class="row">
      
        <?php require("../templates/login/dash/side_nav.php"); ?>
       <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id='main_container' style='background-color:rgba(255,255,255,.7)'>
           <!-- overview stuff -->
           <div class='overview'>
           <?php require("../templates/login/dash/overview/top_teams.php"); ?> 
           <?php require("../templates/login/dash/overview/club_rank.php"); ?> 
           </div>
           
           <!-- container for the blog -->
           <div id='blog' class="container blogy" hidden>
             <?php require("../templates/login/dash/blog/post_area.php");?>
	     <div class="blog-header">
	   	  <h1 class="blog-title">CSULA League of Legends </h1>
	   	  <p class="lead blog-description">The official CSULA League of Legends BlogSpot</p>
              </div>
              <div class="row">
                   <div class="col-sm-8 blog-main" id='blog_post_container'> <!-- blog main -->
                   <?php require("../templates/main/blog/blog_posts.php") ?>
                   </div><!-- /.blog-main -->
                    <?php require("../templates/main/blog/blog_sidebar.php") ?>
               </div><!-- /.row -->
            </div><!-- /.container -->
            
            <!-- team rank container-->
            <div class='team_rank' hidden>
               
               <?php
                  $query = $mysqli->query("select TeamID from Users where Ign='".$_SESSION['user']->name()."'");
                  $result = $query->fetch_assoc();
                  if($_SESSION["user"]->hasTeam()){
                  	require("../templates/login/dash/team_rank/profile.php");
                  	require("../templates/login/dash/team_rank/members.php"); 
                  	require("../templates/login/dash/team_rank/match_history.php");
                  	
                  }else{
                      echo " <div>
          <h1 style='text-align:center;'> You are not currently part of a team</h1>
          <button type='button' class='btn btn-warning btn-lg btn-block' id='browse_team'>Browse Teams</button>
          <button type='button' class='btn btn-default btn-lg btn-block' id='create_team'>Create Team</button>
          <div id='team_list' hidden> </div>";
                  	  
                  }
            
               ?>
            </div>
            
            
                               
        </div>       
      </div>
    </div> 
    
     <?php require("../templates/login/dash/modals/post.php");?> <!-- blog commit modal -->
     <?php 
        //team rank modals
        require("../templates/login/dash/modals/team_decide.php");
        require("../templates/login/dash/modals/create_team.php");
     
     ?>
     
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <script src='./js/jquery/jquery.min.js'></script>
    <script src="./js/bootstrap/bootstrap.min.js"></script>
    <script src="./js/custom/docs.min.js"></script>
     <!-- Custom code -->
     <script src="./js/custom/dashboard.js"></script>
  </body>
</html>
