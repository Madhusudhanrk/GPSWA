 
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
       <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index"><i class='fa fa-home'></i> Home</a>
            </div>
			
        <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
<?php
     $query = "SELECT * FROM categories";
     $categories_queryrun = mysqli_query($dbcon,$query);
     while($row = mysqli_fetch_assoc($categories_queryrun)){
       $cat_id = $row['cat_id'];
	     $cat_title = $row['cat_title'];             //active code. nav

       $category_class='';
       $static_class='';
       $registered_class='registration.php';

       $pagename=basename($_SERVER['PHP_SELF']);
       if(isset($_GET['category'])&&$_GET['category']==$cat_id){
          $category_class='active';
       }elseif($registered_class == $pagename){
          $static_class='active';
       }
 
       echo "<li class='$category_class'><a href='categories.php?category=$cat_id'>$cat_title</a></li>";
?>
				
<?php }	?>
                <li><a href="admin">Admin</a></li>
                <li class=<?php echo $static_class;?> ><a href="registration">Register</a></li>
                <li><a href="contact">Contact</a></li>

<?php 
     if(isset($_SESSION['userrole'])){
       if(isset($_GET['post_id'])){
         $post_id = $_GET['post_id'];
         echo "<li><a href='admin/posts.php?source=edit_post&post_id=$post_id'>Edit post</a></li>";      
       }   
     }                  
?>		                  
                </ul>
            </div>
        <!-- /.navbar-collapse -->
       </div>
        <!-- /.container -->
</nav>