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
                   Home Page
<small>
        <?php 
         if(isset($_SESSION['username'])){
             echo $_SESSION['username'];
          }
          if(isset($_SESSION['userrole'])&&$_SESSION['userrole']=='admin'){
             echo "<abbr title='Admin' style='border-bottom:none !important;cursor:default !important;'> <i style='font-size:17px;' class='fas fa-user-shield'></i></abbr>";
          }elseif(u_login()){
              echo "<abbr title='Subscriber' style='border-bottom:none !important;cursor:default !important;'> <i style='font-size:17px;' class='fas fa-users'></i></abbr>";
          }
       ?>
</small>
                </h1>
                <?php 
            if(u_login()){
                   $post_user_id = $_SESSION['userid'];
                  if(isset($_SESSION['userrole'])&&$_SESSION['userrole']=='admin'){
                     $query= "SELECT * FROM post WHERE post_user = $post_user_id";
                     echo "<h5 class='text-left bg-success'>Draft Posts Access,Ur Admin</h5>";
                  }else{
                    $query= "SELECT * FROM post WHERE post_status = 'publish' AND post_user = $post_user_id"; 
                  } 
                   $all_posts = mysqli_query($dbcon,$query);
                   $post_count = mysqli_num_rows($all_posts);
                 if($post_count>=1){ 
                   $post_count = ceil($post_count/5);
                   //helps to display page number based on how much posts.
                   if($post_count<1){
                     echo "<h1 class='text-center bg-danger'>No Posts Available</h1>";
                   }
                     
                   if(isset($_GET['page'])){
                       $page_num = $_GET['page'];
                       $limiter = ($page_num*5)-5;     
                   }else{
                     $limiter = 0;
                   } 
             
                ?>

             <!-- First Blog Post -->
            <!-- LIMITING posts per page -->
			  <?php   
         $post_user_id = $_SESSION['userid'];
				 $query  = "SELECT * FROM `post` WHERE post_user = $post_user_id LIMIT 5 OFFSET $limiter";
         //limiter starting if 0 take first record to next 5 if 1 take 1 to next 5
				 $categories_post_query = mysqli_query($dbcon,$query);
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
            //it checks before display posts
			?>
			          <h2>
                  <a href="post.php?post_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                   Posted by <?php echo "<a href='author.php?post_user={$post_user}'>$post_user</a>"; ?>    
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <a href="/cms/post.php?post_id=<?php echo $post_id;?>">
                  <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id;?>">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
			 <?php } }else{echo "<h2 class='text-center bg-primary'>Login As Admin,view Draft Posts Also</h2>";}
       
    }//u_login 
    else{ echo "<h1 class='bg-success text-center'>!Please Login <small style='font-size:.5em;'><a href='registration.php'>Signup</a></small></h1>";}
        ?>     
      

            </div>

             <!-- Blog Sidebar Widgets Column -->
			   <?php include 'includes/sidebar.php';?>
           
        </div> <hr>
        <!-- /.row -->
        
 <ul class="pager">
    <?php 
    if(u_login()){
     if($post_count>=1){
      echo "<span style='color:#0494CF;'>Page </span>"; }
       if(isset($_GET['page'])){
        $page_num = $_GET['page'];
       }else{
        $page_num=1;
       }
       for($i=1;$i<=$post_count;$i++){
        if($i == $page_num){
          echo "&nbsp;<li><a style='background-color:#E5E3E3;box-shadow:.5px .5px .5px .5px grey;' href='index.php?page={$i}'>$i</a></li>";
        }else{
          echo "&nbsp;<li><a href='index.php?page={$i}'>$i</a></li>";
         }
       }
    }   
    ?>
 </ul>
          
       <!--footer-->
	      <?php include 'includes/footer.php';?>
</html>







