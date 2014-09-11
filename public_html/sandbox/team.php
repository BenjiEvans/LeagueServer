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
        <div hidden>
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
      <div style='clear:left;'>
            <h2> <em> Members</em></h2>
            
            <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <img src='../img/glyphicons_332_certificate.png'>
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          speedy847
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
     
      <h3> Club Rank: <span class="text-warning">1</span></h3>
      <p> <span class="text-success">Wins: 5</span> , <span class="text-danger">Losses: 6</span></p>
      <p> 
         <button type="button" class="btn btn-danger team_rank_btn remove" style='color:rgb(0,0,0)'><img src='../img/glyphicons_007_user_remove.png'> Remove from Team</button> 
         <button type='button' class='btn btn-warning team_rank_btn captain' style='color:rgb(0,0,0)'><img src='../img/glyphicons_043_group.png'> Assign as Captain </button>
      </p>
      <a href='#'> View profile</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          JinxIt
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          MorgMaster847
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
      
      </div>
    </div>
  </div>
</div>
            
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
          
          <!-- team rank model -->
          <!-- Modal Start---->
  <div id="team_rank_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="login_modal_label">Confirm!</h4>
        </div>
        <div class="modal-body" id='team_modal_body'>
       
        </div>
        <div class="modal-footer">
          <button id='confirm_choice' type="button" class="btn btn-warning" style='float:left' data-dismiss="modal" data-toggle="modal">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
<!-- modalEnd --->


          
          </div>
         <!-- Team content end -->
         
         <!-- no team start -->
         <div>
          <h1 style='text-align:center;'> You are not currently part of a team</h1>
          <button type="button" class="btn btn-warning btn-lg btn-block" id='browse_team'>Browse Teams</button>
          <button type="button" class="btn btn-default btn-lg btn-block" id='create_team'>Create Team</button>
	   <div class="table-responsive" id='team_list' hidden>
	       <table class="table table-bordered">
		   <thead>
		     <tr>
		       <th>Team Name</th>
		       <th>Wins</th>
		       <th>Losses</th>
		       <th>Status</th>
		       <th> </th>
		     </tr>
		   </thead>
		   <tbody>
		      <tr>
		         <td> JBlap</td>
		         <td> <span class='badge win'>5</span></td>
		         <td> <span class='badge loss'>3</span></td>
		         <td>Challenger</td>
		         <td> <a href='#'>view profile</a></td>
		    </tbody>
		</table>
	    </div>
	    	              
         </div>
         
         <!-- no team end -->
         
         <!-- team create modal -->
         
         <div id="team_form" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="login_modal_label">Create team</h4>
        </div>
        <div class="modal-body" id='team_modal_body'>
       
        </div>
        <div class="modal-footer">
          <button id='create_team_confirm' type="button" class="btn btn-warning" style='float:left' data-dismiss="modal" data-toggle="modal">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
  
   <!--- team creat modal end -->
         
         
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
