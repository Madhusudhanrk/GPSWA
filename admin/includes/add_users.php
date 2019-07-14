<?php 
 if(isset($_POST['create_user'])){	 
	$user_firstname = escape($_POST['user_firstname']);
	$user_lastname = escape($_POST['user_lastname']);
	$username = escape($_POST['username']);
	$user_email = escape($_POST['user_email']);
	$user_role = escape($_POST['user_role']);
	$user_password = escape($_POST['user_password']);
 
	$user_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>8));
      
	$query = "INSERT INTO users(user_firstname,user_lastname,username,user_email,user_role,user_password)VALUES('{$user_firstname}','{$user_lastname}','{$username}','{$user_email}','{$user_role}','{$user_password}')";
	 $add_users_query = mysqli_query($dbcon,$query);
     querychecker($add_users_query);
     echo "<h4 class='bg-success'>User Added &nbsp;&nbsp;<a href='./users.php'>View Users</a></h4>";	 
 }
?>

<h2>Add Post:</h2>
<form action="" method="post" enctype="multipart/form-data">
	
	<div class="form-group">
		<label for="Username">Username</label>
		<input class="form-control" type="text" name="username" required>
	</div>
	
	<div class="form-group">
		<label for="Firstname">Firstname</label>
		<input type="text" class="form-control" name="user_firstname" required>
	</div>

	<div class="form-group">
		<label for="Lastname">Lastname</label>
		<input type="text" class="form-control" name="user_lastname" required>
	</div>

    <div class="form-group" style="min-width:100px;max-width:120px;">
    	<option value=""><b>Select Role</b></option> 
    	<select name="user_role" id="" class="form-control">
    		<option value="admin">Admin</option>
    		<option value="subscriber">Subscriber</option>
    	</select>
    </div>

	<div class="form-group">
		<label for="Email">Email</label>
		<input type="text" class="form-control" name="user_email" required>
	</div>
	<div class="form-group">
		<label for="Password">Password</label>
		<input class="form-control" type="password" name="user_password" required>
	</div>
	<div class="form-group">	
		<input type="submit" class="btn btn-primary" name="create_user" value="New User">
	</div>
</form>