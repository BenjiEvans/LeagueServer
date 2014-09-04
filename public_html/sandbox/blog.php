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

    <div class="container-fluid" >
    
             
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
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        
        <div>
             <form role="form">
		  <div class="form-group">
			<label for="login_email"><img src='../img/glyphicons_150_edit.png'>Post </label>
			<textarea id='user_post' class="form-control" rows="3" data-toggle="tooltip" title="this box is resizable (drag bottom-right corner)"> Got something to say?</textarea>
			<button id='post' type="button" class="btn btn-warning" style="float:left" data-toggle='modal' data-target='#post_modal'>Post</button>
		  </div>
             </form>
        </div>
    
       
       
         <div id='blog' class="container">
	   <div class="blog-header">
	   	<h1 class="blog-title">CSULA League of Legends </h1>
	   	<p class="lead blog-description">The official CSULA League of Legends BlogSpot</p>
           </div>
                <div class="row">
                   <div class="col-sm-8 blog-main"> <!-- blog main -->
                   <?php require("../../templates/main/blog_posts.php") ?>
                   </div><!-- /.blog-main -->
                    <?php require("../../templates/main/blog_sidebar.php") ?>
                </div><!-- /.row -->
             </div><!-- /.container -->
             
             <?php require("../../templates/login/dash/modals/post.php");?>
                       
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
