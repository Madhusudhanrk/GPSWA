 
     <!-- ADMIN USERS -->
  
        <!-- Header -->
    
    <?php include 'includes/admin_header.php';?>
    
    <div id="wrapper">
        
        <!-- Navigation -->
    <?php include 'includes/admin_nav.php';?>
   
        
		<div id="page-wrapper">
       <?php
         if(!is_admin($_SESSION['username'])){
             $username = $_SESSION['username'];
             echo "<h2 class='bg-danger'><i  style='color:#D3D533' class='fa fa-warning'></i> Access Denied <small>$username, Ur Subscriber.</small></h2>";
           }else{  
       ?>

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Welcome to users
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
                       
                        <?php 
                           if(isset($_GET['source'])){
                              $source = $_GET['source'];                       
                           }else{
                              $source="";
                           }
                           switch ($source){
                                 case 'add_users':
                                    include 'includes/add_users.php';
                                    break;
                                 case 'edit_users':
                                    include 'includes/edit_users.php';
                                    break;
                                 default:
                                    include 'includes/view_all_users.php';
                                    break;
                              }    
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div><?php  } ?>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include 'includes/admin_footer.php';?>
