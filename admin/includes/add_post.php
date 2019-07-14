

<?php 
//ADDING POST CODE
 if(isset($_POST['create_post'])){
 	$post_category_id = escape($_POST['post_category_id']);
	$post_title =escape($_POST['title']);
	$post_user =escape($_POST['user']);
    $post_date =escape(date("d-m-y"));

	$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];
	
	$post_content = escape($_POST['post_content']);
	$post_tags =escape($_POST['post_tags']);
	$post_status = escape($_POST['post_status']);
	 move_uploaded_file($post_image_temp,"../images/$post_image");

	 $query = "INSERT INTO post(post_category_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status)VALUES($post_category_id,'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
	 $add_post_query = mysqli_query($dbcon,$query);
	 if(!$add_post_query){
	 	die("failed .".mysqli_error($dbcon));
	 }
	   
 }
//--*/ADDING POST CODE

?>

<h2>Add Post:</h2>
 <?php 
 //POST ADDING CONFIRMATION CODE AND LINKS TO VIEWALL POSTS
   if(isset($_POST['create_post'])){
      echo "<div class='bg-success'><span style='font-size:1.2em;'>Post Added&nbsp;<span><a style='font-size:1em;' href='posts.php'>view all posts</a></div>";
   }
//--*/POST ADDING CONFIRMATION CODE   
 ?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title" required>
	</div>
	
	<div class="form-group" style="min-width:100px;max-width:120px; ">
<!-- POST_CATEGORY_ID GETTING FROM CATEGORY ID FOR SELECTING CATEGORY		 -->
        <label for="Role">Category:</label>
		 <select name="post_category_id" id="" class="form-control" >
		 	<?php 
                $query="SELECT * FROM categories";
                $categories_query = mysqli_query($dbcon,$query);
                while($row=mysqli_fetch_assoc($categories_query)){
                    $cat_id = $row['cat_id'];
                	$cat_title=$row['cat_title'];
                	echo "<option value=$cat_id>{$cat_title}</option>";
                }
		 	?>
		 </select>
<!--//* POST_CATEGORY_ID GETTING FROM CATEGORY ID FOR SELECTING CATEGORY		 -->
	</div>

<!-- FETCHING USERS AND USING IN SECTION -->
   <div class="form-group" style="min-width:100px;max-width:120px; ">
         <label for="Role">Users:</label>
		 <select name="user" id="" class="form-control" >
		 	<?php 
                $query="SELECT * FROM users";
                $users_query = mysqli_query($dbcon,$query);
                while($row=mysqli_fetch_assoc($users_query)){
                    $user_id = $row['user_id'];
                	$user_name =$row['username'];
                	echo "<option value=$user_id>{$user_name}</option>";
                }
		 	?>
		 </select>
 	</div>
<!-- END FETCHING USERS AND USING IN SECTION -->
 
	<div class="form-group" style="min-width:100px;max-width:110px;">
		<label for="Role">Role:</label>
		 <select name="post_status" class="form-control">
		 	   <option value="publish">publish</option>
		 	   <option value="draft">draft</option>
		 </select> 
	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image" required>
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags" required>
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label><br>
		<textarea name="post_content" id="myeditor" cols="50" rows="14" required> </textarea>
	</div>

	<div class="form-group">	
		<input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
	</div>
</form>