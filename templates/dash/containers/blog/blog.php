<div id='blog' class="container blogy" hidden>
             <?php require("../templates/dash/containers/blog/post_area.php");?>
	     <div class="blog-header">
	   	  <h1 class="blog-title">CSULA League of Legends </h1>
	   	  <p class="lead blog-description">The official CSULA League of Legends BlogSpot</p>
              </div>
              <div class="row">
                   <div class="col-sm-8 blog-main" id='blog_post_container'> <!-- blog main -->
                   <?php require("../templates/scaffolds/posts.php") ?>
                   </div><!-- /.blog-main -->
                    <?php require("../templates/index/containers/blog/sidebar.php") ?>
               </div><!-- /.row -->
</div><!-- /.container -->
