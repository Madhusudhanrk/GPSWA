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
                    Search Results
                    <small><?php echo $_SESSION['username'];?></small>
                </h1>

             <!-- First Blog Post -->
			 
			  <?php   
				   if(isset($_POST['searchinput'])){
					   $searchinput = escape($_POST['searchinput']);
					   $query = "SELECT * FROM post WHERE post_tags LIKE '%$searchinput%' ";
					   $search_query = mysqli_query($dbcon,$query);
					   $count = mysqli_num_rows($search_query);
					   if($count == 0){
						   echo 'No related keys';
					   }else{
						 while($row = mysqli_fetch_assoc($search_query)){
							 $post_title = $row['post_title'];
				             $post_user = $row['post_user'];
                              $query = "SELECT * FROM users WHERE user_id=$post_user";
                              $user_name_query = mysqli_query($dbcon,$query);
                              querychecker($user_name_query);
                              while($row = mysqli_fetch_assoc($user_name_query)){
                                $post_user = $row['username'];
                              }
							 $post_date = $row['post_date'];
							 $post_image = $row['post_image'];
							 $post_content = $row['post_content'];                   
			  ?>
			    <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_user; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
			 <?php     }  
					 }   
				   } 
			   ?>
			  
            </div>

             <!-- Blog Sidebar Widgets Column -->
			   <?php include 'includes/sidebar.php';?>
           
        </div>
        <!-- /.row -->

        <hr>
       <!--footer-->
	      <?php include 'includes/footer.php';?>
</html>



 












































































 <!-- Second Blog Post 
                <h2>
                    <a href="#">Blog Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, quasi, fugiat, asperiores harum voluptatum tenetur a possimus nesciunt quod accusamus saepe tempora ipsam distinctio minima dolorum perferendis labore impedit voluptates!</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>-->

                <!-- Third Blog Post
                <h2>
                    <a href="#">Blog Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, voluptates, voluptas dolore ipsam cumque quam veniam accusantium laudantium adipisci architecto itaque dicta aperiam maiores provident id incidunt autem. Magni, ratione.</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr> -->

