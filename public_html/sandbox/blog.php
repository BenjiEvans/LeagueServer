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
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    
    <!-- Styling for blog -->
    <link href="../css/custom/layout.css" rel="stylesheet">
    
     <style>
     .win{
     	    background-color:rgb(0,255,0);
     	    color:rgb(0,0,0);
        }
        
     .loss{
     	     
     	    background-color:rgb(255,0,0); 
     	    color:rgb(0,0,0);
     }
     </style>
     
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
      
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Welcome Summoner!</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="../main.php?rq=logout">logout</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
    
             
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li id='overview' class="dash_link"><a href="#">Overview</a></li>
            <li id='blog' class="dash_link active"><a href="#">Blog</a></li>
            <li id='team_rank' class="dash_link"><a href="#">Team Rank</a></li>
            <li id='event' class="dash_link"><a href="#">Events <span class='badge'> display # of posted events</span></a></li>
            <li id='control_panel' class="dash_link"><a href="#">Control Panel</a></li>
          </ul>
        </div>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style='padding:0px;'>
           
        
         <div id='blog' class="container" style='float:left;width:800px;height:500px;overflow-y: scroll;'>
	   <div class="blog-header">
	   	<h1 class="blog-title">CSULA League of Legends </h1>
	   	<p class="lead blog-description">The official CSULA League of Legends BlogSpot</p>
           </div>
                <div class="row" style=''>
                   <div class="col-sm-8 blog-main"> <!-- blog main -->
                   <?php require("../../templates/main_index/blog_posts.php") ?>
                   <ul class="pager">
                      <li><a href="#">Previous</a></li>
                      <li><a href="#">Next</a></li>
                   </ul>
                   </div><!-- /.blog-main -->
                </div><!-- /.row -->
             </div><!-- /.container -->
 
             <!--side bar-->
            <div style='width:250px;float:right;overflow:scroll;'>
               <div class="sidebar-module sidebar-module-inset" > <!-- Global notifications -->
                <h4>About</h4>
			<p> Mr. President, if you are reading this then it is pretty evident that we need 
			a better, more meaning full statement to fill this spot on the page.
			Until then... this will have to do for now :D
			</p>
                 </div> <!-- Global notifications -->
                 <div class="sidebar-module">
            <h4>Links</h4>
            <ol class="list-unstyled">
             
              <li><a href="http://www.twitch.tv/csula_lol" target="_blank">Twitch</a></li>
              <li><a href="https://www.facebook.com/groups/CSULALeagueOfLegendsClub/" target="_blank">Facebook</a></li>
            </ol>
          </div>
                      
            </div>
           
            

        </div>
      </div> 
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/docs.min.js"></script>
     <!-- Custom code -->
     <script src="./js/custom/dashboard.js"></script>
     <!-- for blog -->
  </body>
</html>
