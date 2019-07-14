
  <!-- ADMIN USERS -->
 
     <!-- Header -->
    
<?php include 'includes/admin_header.php';?>
<?php 
   
   if(isset($_POST['update_profile'])){
      $user_firstname = escape($_POST['user_firstname']);
      $user_lastname = escape($_POST['user_lastname']);
      $username = escape($_POST['username']);
      $user_email = escape($_POST['user_email']);
      $user_password = escape($_POST['user_password']);
      $user_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>8));
      $query = "UPDATE users SET username ='{$username}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}',user_password='{$user_password}' WHERE username='$username'";   
        $user_profile_update_query = mysqli_query($dbcon,$query);
        querychecker($user_profile_update_query);
        echo "<h5 class='bg-success'>Profile Updated</h5>";      
   }
   
   if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $query="SELECT * FROM users WHERE username='{$username}'";
    $select_user_profile_query = mysqli_query($dbcon,$query);
    while($row = mysqli_fetch_assoc($select_user_profile_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];  
    }
   }
?>

<div id="wrapper">
    
    <!-- Navigation -->
<?php include 'includes/admin_nav.php';?>
    
  <div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
      <div class="row">

        <div class="col-lg-12"> 
          <h1 class="page-header">
              Welcome to profile
              <small><?php echo $_SESSION['username'];?></small>
          </h1>
        <?php 
           $username = $_SESSION['username'];
           echo "<img style='border-radius:50px; width:15%;' src='../images/$username.jpg' alt='no image'>";
        ?> 
  <br><br><form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
      <label for="Username">Username</label>
      <input value="<?php echo $username;?>" class="form-control" type="text" name="username">
    </div>

    <div class="form-group">
      <label for="Firstname">Firstname</label>
      <input value="<?php echo $user_firstname;?>" type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
      <label for="Lastname">Lastname</label>
      <input value="<?php echo $user_lastname;?>" type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
      <label for="Email">Email</label>
      <input value="<?php echo $user_email;?>" type="text" class="form-control" name="user_email">
    </div>
  
    <div class="form-group">
      <label for="Password">Password</label>
      <input autocomplete="off" class="form-control" type="text" name="user_password" placeholder="Hidden Password" required>
    </div>

    <div class="form-group">  
      <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
    </div>
</form>
                                  
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include 'includes/admin_footer.php';?>


