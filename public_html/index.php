<?php require("../templates/header.php")?>
<!-- NAVBAR
================================================== -->
  <body>
   
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src='./img/background2.jpg' />
        <!--- <div class="container">
            <div class="carousel-caption">
              <h1>Example headline.</h1>
              <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>-->
        </div>
        <div class="item">
          <img src='./img/team.jpg'>
         <!-- <div class="container">
            <div class="carousel-caption">
              <h1>Another example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div> -->
        </div>
        <div class="item">
           <img src='./img/banner.jpg'>
         <!--<div class="container">
            <div class="carousel-caption">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>-->
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
	
	<div class='content'>
			<!--<h1 style='text-align:center'> Welcome! </h1>
			<p> This site is currently under construction!
				Stay tunned for more updates and more interesting contetnt comming 
				your way! 
			</p> -->
			 <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">CSULA League of Legends </h1>
        <p class="lead blog-description">The official CSULA League of Legends BlogSpot</p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">

          <div class="blog-post">
            <h2 class="blog-post-title">Hello World!</h2>
            <p class="blog-post-meta">May 18, 2014 by <a href="#">Benji</a></p>
			
			<p> 
				It took a while but here we are! With over 180 members (and counting),
				our club now has an official website :D. From this page you can link to the 
				Schools webiste or the League of Legends site (by clicking on the images in the navigation Bar) and can also 
				link to our facebook page and twitch stream (links should be on the right... might have to scroll?). The website is 
				still under construction so stay tuned for more interesting content.
				
			</p>
          
          </div><!-- /.blog-post -->

          <ul class="pager">
            <li><a href="#">Previous</a></li>
            <li><a href="#">Next</a></li>
          </ul>

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
			<p> Mr. President, if you are reading this then it is pretty evident that we need 
			a better, more meaning full statement to fill this spot on the page.
			Until then... this will have to do for now :D
			</p>
            <!--<p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>-->
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              <li><a href="#">January 2014</a></li>
              <li><a href="#">December 2013</a></li>
              <li><a href="#">November 2013</a></li>
              <li><a href="#">October 2013</a></li>
              <li><a href="#">September 2013</a></li>
              <li><a href="#">August 2013</a></li>
              <li><a href="#">July 2013</a></li>
              <li><a href="#">June 2013</a></li>
              <li><a href="#">May 2013</a></li>
              <li><a href="#">April 2013</a></li>
              <li><a href="#">March 2013</a></li>
              <li><a href="#">February 2013</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <!--<li><a href="#">GitHub</a></li>-->
              <li><a href="http://www.twitch.tv/csula_lol" target="_blank">Twitch</a></li>
              <li><a href="https://www.facebook.com/groups/CSULALeagueOfLegendsClub/" target="_blank">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->
			
			
			
	</div> 
	
	 <div class="blog-footer">
	  <p>Courtesy of your Webmaster <a href="#"> Benji</a> </p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </div>
		
<?php require("../templates/footer.php")?>
