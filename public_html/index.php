<?php session_start();
//if user already logged in redirect to the dash board
  if(isset($_SESSION['user'])){
  	  
  	  header("Location: /dash.php");
  	  exit();
  }
?>

<?php include_once("../scripts/php/mysql_connect.php");?>
<!-- NAVBAR -->
<?php require("../templates/index/header.php")?> 

  <body>
    <!-- Carousel -->
    <?php require("../templates/index/containers/carousel/carousel.php") ?>
	<div class='content'>
	       <?php 
		     require("../templates/index/containers/blog/blog.php");
		?>
	     
         
              <?php require("../templates/index/containers/officers/officers.php") ?>
            			
			
	</div> <!-- /.content -->
	
	<?php 
             require("../templates/index/modals/login.php");
	?>
	<?php 
	      require("../templates/index/modals/register.php");
	?>
	<?php 
	      require("../templates/index/containers/blog/footer.php");
	?>
			
<?php require("../templates/index/footer.php")?>
