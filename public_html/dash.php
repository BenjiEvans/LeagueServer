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

  <body>

    <?php require("../templates/login/dash/top_nav.php"); ?>
    
    <div class="container-fluid">
      <div class="row">
      
        <?php require("../templates/login/dash/side_nav.php"); ?>
       <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id='main_container'>
           <!-- overview stuff -->
           <?php require("../templates/login/dash/overview/top_teams.php"); ?> 
           <?php require("../templates/login/dash/overview/club_rank.php"); ?> 
           
           <!-- container for the blog -->
           <?php require("../templates/login/dash/blog/post_area.php");?>
           <div id='blog' class="container blogy" hidden>
	     <div class="blog-header">
	   	  <h1 class="blog-title">CSULA League of Legends </h1>
	   	  <p class="lead blog-description">The official CSULA League of Legends BlogSpot</p>
              </div>
              <div class="row">
                   <div class="col-sm-8 blog-main"> <!-- blog main -->
                   <?php require("../templates/main/blog/blog_posts.php") ?>
                   </div><!-- /.blog-main -->
                    <?php require("../templates/main/blog/blog_sidebar.php") ?>
               </div><!-- /.row -->
            </div><!-- /.container -->
             
            
             
             
                               
        </div>       
      </div>
    </div> 
    
     <?php require("../templates/login/dash/modals/post.php");?> <!-- blog commit modal -->
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
