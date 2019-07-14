<?php 
 if(isset($_GET['edit_users_id'])){
        $edit_users_id= $_GET['edit_users_id'];   
  }
 if(isset($_POST['update_user'])){   
  $user_firstname = escape($_POST['user_firstname']);
  $user_lastname = escape($_POST['user_lastname']);
  $username = escape($_POST['username']);
  $user_email = escape($_POST['user_email']);
  $user_role = escape($_POST['user_role']);
  $user_password =escape($_POST['user_password']);
     
   $hashpassword =  password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>8));
   
    $query = "UPDATE users SET username ='{$username}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}',user_role='{$user_role}',user_password='{$hashpassword}' WHERE user_id=$edit_users_id";
        //user id getting from the url.
        $user_update_query = mysqli_query($dbcon,$query);
        querychecker($user_update_query);
        echo "<h5 class='bg-success'>User Updated</h5>";
  }         
?>


<?php 
   
   $query="SELECT * FROM users WHERE user_id = $edit_users_id";
   $select_all_users = mysqli_query($dbcon,$query);
   while($row = mysqli_fetch_assoc($select_all_users)){
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $username = $row['username'];
      $user_email = $row['user_email'];
      $user_role = $row['user_role'];

?>

<h2>Edit User:</h2>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">

  <div class="form-group">
    <label for="Username">Username</label>
    <input class="form-control" type="text" name="username" value="<?php echo $username;?>" required>
  </div>
   
    <label for="Firstname">Firstname</label>
    <input value="<?php echo $user_firstname;?>" type="text" class="form-control" name="user_firstname" required>
  </div>

  <div class="form-group">
    <label for="Lastname">Lastname</label>
    <input value="<?php echo $user_lastname;?>" type="text" class="form-control" name="user_lastname" required>
  </div>

    <div class="form-group" style="min-width:100px;max-width:120px;" >
      <select name="user_role" id="" class="form-control">
        <option value="<?php echo $user_role;?>"> <?php echo "$user_role";?></option>
        <?php 
          if($user_role=='admin') {
            echo "<option value='subscriber'>subscriber</option>";
          }else{
            echo "<option value='admin'>admin</option>";
          }
        ?>
      </select>
    </div>

  <div class="form-group">
    <label for="Email">Email</label>
    <input value="<?php echo $user_email;?>" type="text" class="form-control" name="user_email" required>
  </div>
  
  <div class="form-group">
    <label for="Password">Password</label>
    <input autocomplete="off" class="form-control" type="password" name="user_password" placeholder="Enter Password" required>
  </div>

  <div class="form-group">  
    <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
  </div>
</form>
<?php } ?>