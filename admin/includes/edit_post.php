<h3>UPDATE POST:</h3>
<?php
    if(isset($_GET['post_id'])){
    	$view_edit_id = $_GET['post_id'];
    }
   $query = "SELECT * FROM post WHERE post_id=$view_edit_id";
          $select_posts = mysqli_query($dbcon,$query);
          while($row = mysqli_fetch_assoc($select_posts)){
            $post_id = $row['post_id'];
            $post_user = $row['post_user'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
          }
      if(isset($_POST['update_post'])){
 
            $post_user = escape($_POST['post_user']);
            $post_title = escape($_POST['post_title']);
            $post_category_id = escape($_POST['post_category_id']);
            $post_status = escape($_POST['post_status']);    
            $post_image = $_FILES['image']['name'];
            $post_image_tmp = $_FILES['image']['tmp_name'];
            $post_tags = escape($_POST['post_tags']);
            $post_content = escape($_POST['post_content']);
                move_uploaded_file($post_image_tmp,"../images/$post_image");
        
              if(empty($post_image)){
              	   $query="SELECT * FROM post WHERE post_id=$view_edit_id ";
              	   $post_img_query = mysqli_query($dbcon,$query);
              	   while($row = mysqli_fetch_assoc($post_img_query)) {
              	   	 $post_image = $row['post_image'];
              	   }
              }  
              
          $query = "UPDATE post SET post_category_id='{$post_category_id}',post_title='{$post_title}',post_user='{$post_user}',post_date=now(),post_image='{$post_image}',post_content='{$post_content}',post_tags='{$post_tags}',post_status='{$post_status}' WHERE post_id=$view_edit_id ";
          $update_query = mysqli_query($dbcon,$query);
          if(!$update_query){
          	echo "query failed".mysqli_error($dbcon);
          }
          
         echo "<div class='bg-success'><span>Post Updated&nbsp;<span> <a href='../post.php?post_id=6'>view post</a> || <a href='posts.php'>view all posts</a></div>";
      }                          
?>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="post_title">Post Title</label>
			<input value="<?php echo $post_title;?>" type="text" class="form-control" name="post_title" required>
		</div>
		
		<div class="form-group" style="min-width:100px;max-width:120px;">
       <label for="post_category">Post Category</label>
			 <select name="post_category_id" id="" class="form-control">  
			 	<?php 
           if(isset($_GET['$post_category_id'])){
              $post_category_id = $_GET['$post_category_id'];
           }
           $query="SELECT * FROM categories WHERE cat_id=$post_category_id ";
                        $category_query = mysqli_query($dbcon,$query);
                        while($row = mysqli_fetch_assoc($category_query)){
                            $p_cat_id = $row['cat_id'];
                      //passing category id based on cat_title to view all posts using.      
                            $p_cat_title = $row['cat_title'];
                        } 
                       
                echo "<option value='$p_cat_id'>{$p_cat_title}</option>"; 
        //till this the above code is used to display dbcategory.                          
           $query="SELECT * FROM categories";
           $select_category_query = mysqli_query($dbcon,$query);
           while($row = mysqli_fetch_assoc($select_category_query)){
           	    $p_cat_id = $row['cat_id'];
           	    $p_cat_title = $row['cat_title'];                
           	    echo "<option value='$p_cat_id'>{$p_cat_title}</option>";
           }
			 	?>
			 </select>
		</div>

    <div class="form-group" style="min-width:100px;max-width:120px;">
      <label for="post_user">Post User</label>
      <select name="post_user" id="" class="form-control">
          <?php 
              $query = "SELECT * FROM users";
              $select_users_query = mysqli_query($dbcon,$query);
              while($row=mysqli_fetch_assoc($select_users_query)){
                $user_id = $row['user_id'];
                $user_name = $row['username'];
                echo "<option value='$user_id'>{$user_name}</option>";
              }
          ?>
      </select>
     </div>

		<div class="form-group" style="min-width:100px;max-width:120px;">
      <label for="post_status">Post Status</label>
			<select name="post_status" class="form-control">
        <?php 
              echo "<option value='$post_status'>$post_status</option>";  
              if($post_status ==='publish'){
                echo "<option value='draft'>draft</option>";
              }else{
                echo "<option value='publish'>publish</option>";
              }            
        ?>
      </select>
		</div>

		<div class="form-group">
			<img width="100" src="../images/<?php echo $post_image;?>" alt="">
			<input type="FILE" name="image" >
		</div>

		<div class="form-group">
			<label for="post_tags">Post Tags</label>
			<input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags" required>
		</div>

		<div class="form-group">
			<label for="post_content">Post Content</label><br>
			<textarea name="post_content" id="myeditor" cols="50" rows="4" required>
			   <?php echo $post_content;?>	
			</textarea>
			 
		</div>

		<div class="form-group">	
			<input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
		</div>
	</form>