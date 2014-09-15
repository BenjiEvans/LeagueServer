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
        <!-- Team content start -->
        <div>
        <h1> JBlap <em><span class="text-muted officer">Challenger</span></em></h1> <hr class="featurette-divider">
          <img class="featurette-image img-responsive" data-src="holder.js/200x200/auto" alt="Generic placeholder image" style='border:solid;float:left'>
          <div style='float:left;margin-left:10px;'>
            <h2> <span style="font-family:Fertigo">Club Rank</span> : <span class="text-muted officer">1</span></h2>
            <h2> <span style="font-family:Fertigo">Team Captain</span>: <span class="text-warning">speedy847</span> </h2>
            <h3> <span class="text-success" > Wins: 5 </span> </h3>
            <h3> <span class="text-danger"> Losses: 2 </span></h3>
             <button type="button" class="btn btn-danger team_rank_btn leave" style='color:rgb(0,0,0)'><img src='../img/glyphicons_007_user_remove.png'> Leave Team</button> 
           
          </div> 
          <!-- members start -->
      <div style='clear:left;' class="panel panel-default">
          
     
           <ul class="list-group">
		  <li class="list-group-item">Cras justo odio</li>
		  <li class="list-group-item">Dapibus ac facilisis in</li>
		  <li class="list-group-item">Morbi leo risus</li>
		  <li class="list-group-item">Porta ac consectetur ac</li>
		  <li class="list-group-item">Vestibulum at eros</li>
		</ul>
      
      
          </div> <!-- member end -->
          
          <!-- match history -->
          <h2> Match History </h2>
          <table class="table table-bordered">
               <thead>
                <tr>
                  <th>#</th>
                  <th>Team Versus</th>
                  <th>Kills</th>
                  <th>Deaths</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody>
                <tr class="success">
                  <td>1</td>
                  <td> Avengers </td>
                  <td><span class="badge win">10</span></td>
                  <td><span class="badge loss">7</span></td>
                  <td>32:40</td>
                </tr>
                 <tr class="danger">
                  <td>2</td>
                  <td> KillTotal </td>
                  <td><span class="badge win">2</span></td>
                  <td><span class="badge loss">20</span></td>
                  <td>15:53</td>
                </tr>
              </tbody>    
  
          </table>
          
        
          
          </div>
         <!-- Team content end -->
         
        
         
         
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
