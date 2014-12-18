<div id='blog' class="container" >
     <?php require("../templates/index/containers/blog/header.php") ?>
     <div class="row">
         <div class="col-sm-8 blog-main"> <!-- blog main -->
                   <?php require("../templates/scaffolds/posts.php") ?>
                   <!--<ul class="pager">
                      <li><a href="#">Previous</a></li>
                      <li><a href="#">Next</a></li>
                   </ul> -->
         </div><!-- /.blog-main -->
                   <!-- blog sidebar -->
                   <?php require("../templates/index/containers/blog/sidebar.php") ?>
      </div><!-- /.row -->
</div><!-- /.container -->
