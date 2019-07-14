        <!-- Header -->
    
    <?php include 'includes/admin_header.php';?>
    
    <!--DISPLAYING COMMETS BY USING SOME FILES INSIDE INCLUDES LIKE VIEW ALL COMMENTS,EDIT_COMMETNTS USING SWITHCH STATEMENTS  -->

    <div id="wrapper">
        
        <!-- Navigation -->
    <?php include 'includes/admin_nav.php';?>
        
		<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Welcome to comments
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
                       
            <?php 
              include 'includes/view_all_comments.php';                            
            ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include 'includes/admin_footer.php';
