   


    <!-- SIDEBAR CATEGORIES DISPLAYING USING CMS/CATEGORIES.PHP IT IS COPY OF CMS/INDEX.PHP BUT IF WE PRESS ANY
      CATEGORY PRESENT IN THE SIDEBAR THE RELATED category=id transpered to CATEGORY.PHP and compare the 
        id to post_category_id and display the selected post. 
 -->


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
                  <?php  
                     $username = $_SESSION['username'];
                     echo "Category Page ";
                     echo "<small>$username</small>";
                  ?>  
                </h1>

             <!-- First Blog Post -->
			 
			  <?php  
                 if(isset($_GET['category'])){
                        $post_category_id = $_GET['category'];
                 } 
       if($_SESSION['userrole']=='admin'){ 
           $query  = "SELECT * FROM post WHERE post_category_id = $post_category_id";

       }else{
          $query  = "SELECT * FROM post WHERE post_category_id = $post_category_id AND post_status = 'publish'";
       }         
				 $categories_post_query = mysqli_query($dbcon,$query);
         if(mysqli_num_rows($categories_post_query)<1){
              echo "<h2 class='text-center bg-danger'>No Category's Available</h2>";
         }
				 while($row = mysqli_fetch_assoc($categories_post_query)){
                     $post_id = $row['post_id'];
          					 $post_title = $row['post_title'];
          					 $post_user_id = $row['post_user'];
                        $query = "SELECT * FROM users WHERE user_id = $post_user_id";
                        $select_post_byuser = mysqli_query($dbcon,$query);
                        $rows = mysqli_fetch_assoc($select_post_byuser);
                     $post_user = $rows['username'];
          					 $post_date = $row['post_date'];
          					 $post_image = $row['post_image'];
          					 $post_content = $row['post_content'];
                     $post_status = $row['post_status'];
			   ?>
			    <h2>
                    <a href="post.php?post_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    Posted by <a href="index.php"><?php echo $post_user; ?></a>
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
			 <?php } ?>
                
              

            </div>

             <!-- Blog Sidebar Widgets Column -->
			   <?php include 'includes/sidebar.php';?>
           
        </div>
        <!-- /.row -->

        <hr>
       <!--footer-->
	      <?php include 'includes/footer.php';?>
</html>



 












































































  