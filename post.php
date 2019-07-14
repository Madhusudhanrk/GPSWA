<!-- POST.PHP IT IS A COPY OF CMS HOME/INDEX.PHP IF WE CLICK ANY POST TITLE IT WILL GO TO THAT POST BASED ON POST ID Href post.php?post_id=$post_id HERE COMMENT OPTION AVAILABLE FOR THAT POST.
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
                Post Comment
                 
            </h1>

         <!-- First Blog Post -->
         
 <?php  

  if(isset($_GET['post_id'])){
     $index_post_id = $_GET['post_id'];
    //POST_VIEWS_COUNT     
        $query="UPDATE post SET post_views_count=post_views_count + 1 WHERE post_id = {$index_post_id}";
        $post_views_count_query = mysqli_query($dbcon,$query);  
        if(!$post_views_count_query){
            die("post_views_count_query FAILED".mysqli_error($dbcon));
        }
    //--POST_VIEWS_COUNT 

   //POST_DISPLAYED BASED ON ID and checking WHETHER USER IS ADMIN OR SUBSCRIBER.
     if(isset($_SESSION['userrole'])&&$_SESSION['userrole']=='admin'){
            $query  = "SELECT * FROM post WHERE post_id=$index_post_id";
     }else{
           $query  = "SELECT * FROM post WHERE post_id=$index_post_id AND post_status = 'publish' ";
     }   
    
     $categories_post_query = mysqli_query($dbcon,$query);
     if(mysqli_num_rows($categories_post_query)>=1){
     while($row = mysqli_fetch_assoc($categories_post_query)){
         $post_title = $row['post_title'];
         $post_user = $row['post_user'];
         $post_date = $row['post_date'];
         $post_image = $row['post_image'];
         $post_content = $row['post_content'];
 ?>
            <h2>
                <a href="#"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
               Posted by  
                <?php 
                    $select_users = mysqli_query($dbcon,"SELECT * FROM users WHERE user_id = $post_user");
                     $row = mysqli_fetch_assoc($select_users);
                     $post_user = $row['username'];
                     echo "<a href='index.php'>$post_user</a>";     
                ?>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
            <hr>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $post_content; ?></p>
            <hr>
            
     

<!-- //END POST_DISPLAYED BASED ON ID -->
          
         
<?php 
       //$email=$content=" ";
       if(isset($_POST['create_comment'])){
           $index_post_id = escape($_GET['post_id']);
//Getting from index title and image click from particular post.
           $comment_user = escape($_SESSION['username']);
           $comment_email = escape($_POST['comment_email']);
           $comment_content = escape($_POST['comment_content']);
          
        if(!empty($comment_user&&$comment_email&&$comment_content)){      
           $query = "INSERT INTO comments(comment_post_id,comment_user,comment_email,comment_content,comment_status,comment_date)VALUES($index_post_id,'$comment_user','$comment_email','$comment_content','Approved',now())";
            $add_comment_query=mysqli_query($dbcon,$query);
            querychecker($add_comment_query);

        }
    }
    ?>
           
     <!-- BLOG COMMENTS -->

            <!-- Comments Form -->

         <!-- Comment ADD OR Insertion into the DB -->
         
    
    
<div class="well">
    <h4>Leave a Comment:</h4>
    <form action="" method="post" autocomplete="off">
         
        <div class="form-group">
            <label for="e-mail">E-mail </label>
                <input class="form-control type="email" name="comment_email" required ">
        </div>
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea name="comment_content" class="form-control" rows="3" required"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
    </form>
</div>

<hr>


            <!-- Posted Comments -->

            <!-- Comment Displaying-->
<?php 
     $index_comment_post_id = $_GET['post_id'];
     $query = "SELECT * FROM comments WHERE comment_post_id=$index_comment_post_id AND comment_status='approved' ORDER by comment_id DESC";
     $post_comment_display_query=mysqli_query($dbcon,$query);
     if(!$post_comment_display_query){
        die('Query_failed'. mysqli_error($dbcon));
     }
       while($row = mysqli_fetch_assoc($post_comment_display_query)){
          $comment_user = $row['comment_user'];
          $comment_date = $row['comment_date'];
          $comment_content = $row['comment_content'];
?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_user; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>
<?php } ?>
           
           
            
<?php } }else{
                 echo "<h2 class='text-center bg-danger'>In Draft, View Only Admins</h2>";
             }
 }?><!--END GET post id             -->
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

