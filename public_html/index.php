<?php session_start();
//if user already logged in redirect to the dash board
  if(isset($_SESSION['user'])){
  	  
  	  header("Location: /dash.php");
  	  exit();
  }
?>
<!-- NAVBAR -->
<?php require("../templates/main/header.php")?> 

  <body>
    <!-- Carousel -->
    <?php require("../templates/main/carousel.php") ?>
	<div class='content'>
	
	     <!-- container for blog -->
	     <div id='blog' class="container" >
	     <?php require("../templates/main/blog_header.php") ?>
                <div class="row">
                   <div class="col-sm-8 blog-main"> <!-- blog main -->
                   <?php require("../templates/main/blog_posts.php") ?>
                   <ul class="pager">
                      <li><a href="#">Previous</a></li>
                      <li><a href="#">Next</a></li>
                   </ul>
                   </div><!-- /.blog-main -->
                   <!-- blog sidebar -->
                   <?php require("../templates/main/blog_sidebar.php") ?>
                </div><!-- /.row -->
             </div><!-- /.container -->
			
             <!-- officer container -->
             <div id='officers' class="container marketing" hidden>
              <?php require("../templates/main/officers/officers.php") ?>
             </div><!-- /.container -->
			
			
	</div> <!-- /.content -->
	
	<?php require("../templates/main/modal_login.php")?>
	<?php require("../templates/main/modal_register.php")?>
	<?php require("../templates/main/blog_footer.php") ?>
			
<?php require("../templates/main/footer.php")?>
