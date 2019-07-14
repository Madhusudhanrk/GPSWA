    <!--DBCON-->
	<?php 'dbcon.php';?>
    <!--header-->  
	   <?php include 'includes/header.php';?>
  
    <!-- Navigation -->
       <?php include 'includes/nav.php';?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo $_SESSION['username']; ?>
                    <small>Posts</small>
                </h1>

             <!-- First Blog Post -->
			 
			  <?php   
                if(isset($_GET['post_user'])){
                   $index_postauthor = $_GET['post_user'];
                } 
                $query="SELECT * FROM users WHERE username='$index_postauthor'";
                 $post_user_id_query = mysqli_query($dbcon,$query);
                 querychecker($post_user_id_query);//getting user_id using username from url.
                 $row = mysqli_fetch_assoc($post_user_id_query);
                 $post_user_id = $row['user_id'];

				 $query  = "SELECT * FROM post WHERE post_user=$post_user_id";
				 $categories_post_query = mysqli_query($dbcon,$query);
                 querychecker($categories_post_query);
				 while($row = mysqli_fetch_assoc($categories_post_query)){
                     $post_id = $row['post_id'];
					 $post_title = $row['post_title'];
					 $post_users_id = $row['post_user'];
                         $query = "SELECT * FROM users WHERE user_id = $post_users_id";
                          $select_post_byuser = mysqli_query($dbcon,$query);
                          querychecker($select_post_byuser);
                          $rows = mysqli_fetch_assoc($select_post_byuser);
                     $post_user = $rows['username'];     
					 $post_date = $row['post_date'];
					 $post_image = $row['post_image'];
					 $post_content = $row['post_content'];
                     $post_status = $row['post_status'];
                   if($_SESSION['userrole']=='admin'){
                      $post_status ='publish';
                   }
                     if($post_status == 'publish'){
			?>
			    <h2>
                    <a href="post.php?post_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                   Post by <a href="index.php"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post_id;?>">
                  <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id;?>">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
			 <?php }} ?>
                
             
            </div>

             <!-- Blog Sidebar Widgets Column -->
			   <?php include 'includes/sidebar.php';?>
           
        </div>
        <!-- /.row -->

        <hr>
       <!--footer-->
	      <?php include 'includes/footer.php';?>
</html>



 












































































  