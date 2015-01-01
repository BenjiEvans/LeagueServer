<?php
if($status == 1) echo '<div id="blog" class="container blogy" hidden>';
else echo '<div id="blog" class="container blogy">';
?>
<?php require("../templates/dash/containers/blog/post_area.php");?>
<div class="blog-header"><h1 class="blog-title">CSULA League of Legends </h1><p class="lead blog-description">The official CSULA League of Legends BlogSpot</p></div><div class="row"><div class="col-sm-8 blog-main" id='blog_post_container'><?php require("../templates/scaffolds/posts.php") ?></div><?php require("../templates/index/containers/blog/sidebar.php") ?></div></div>
