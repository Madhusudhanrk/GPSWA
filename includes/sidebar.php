<div class="col-md-4">
                <!-- Blog Search Well -->
				
  <div class="well">	
      <h4>Blog Search</h4>
		  <form action="search.php" method="post">
          <div class="input-group">
							<input type="text" name="searchinput" class="form-control">
							<span class="input-group-btn">
								<button name="submit" class="btn btn-default" type="submit">
									<span class="glyphicon glyphicon-search"> </span>
								</button>
							</span>
          </div>
		  </form>	

      
      <?php   //LOGIN AND LOGOUT   
        if(isset($_SESSION['userrole'])&&$_SESSION['username']){
            $username = $_SESSION['username'];
            $msg = stripslashes(mysqli_real_escape_string($dbcon,"You'r Logged in"));
                if($_SESSION['userrole']=='admin'){      
                    echo "<br><h4>$msg $username<i class='fas fa-user-shield'></i></h4>";
                }else{
                    echo "<br><h4>$msg $username<i class='fas fa-users'></i></h4>";
                }
            
            echo "<button class='btn btn-primary' style='padding:7px 20px;font-size:17px;'><a style='color:white;max-width:110px;' href='includes/logout.php'>Logout</a> </button>";
        }else{
      ?>
            <h4>Login</h4>
             <form action="includes/login.php" method="post" autocomplete="off">
                  <div class="form-group">
                     <input type="text" name="login_name" class="form-control" placeholder="username" required>
                  </div>
                  <div class="input-group">  
                      <input type="password" name="login_password" class="form-control" placeholder="password" required>
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="login">Login</button>
                      </span>
                  </div>
              </form> 
       <?php  } ?>
   
                <!-- /.input-group -->
  </div>

                <!-- Blog Categories Well -->
  <div class="well">
    <h4>Blog Categories</h4>
     <div class="row">
       <div class="col-lg-12">
  		   <ul class="list-unstyled">
  				 <?php 
  				   $query = "SELECT * FROM categories";
  				   $select_blog_categories_query = mysqli_query($dbcon,$query);
  				   while($row = mysqli_fetch_assoc($select_blog_categories_query)){
                $cat_id = $row['cat_id'];
  					    $blog_category =  $row['cat_title'];
  					    echo "<li><a href='categories.php?category=$cat_id'>$blog_category</a></li>";
  				   }
  				 ?>
         </ul>     
       </div>     
                        <!-- /.col-lg-6 -->
     </div>
                    <!-- /.row -->
  </div>
        <!-- Side Widget Well -->
        <?php include 'widget.php';?>
</div>