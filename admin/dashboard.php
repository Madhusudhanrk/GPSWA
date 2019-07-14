       
   <!-- ADMIN INDEX IS DASHBOARD -->

        <!-- Header -->
<!-- 1.contain session_start()
     2.included dbfunctions
     3.cat_functions
-->
    <?php include 'includes/admin_header.php';?>
    
    <div id="wrapper">
        
        <!-- Navigation -->
        <?php include 'includes/admin_nav.php';?>
        
		<div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <small>Welcome To Dashboard</small>
                            <?php echo $_SESSION['username']; ?>
                        </h1>
                          
                    </div>
                </div>
                <!-- /.row -->

       
    <!-- WIDJET ROW -->
                
<div class="row">
 <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-file-text fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
              <?php
                  $post_count =recordcount('post');//DASHBOARD DISPLAY.
              ?>      
              <div class='huge'><?php echo $post_count;?></div>
                    <div>Posts</div>
                </div>
            </div>
        </div>
        <a href="posts.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
 </div>
 <div class="col-lg-3 col-md-6">
    <div class="panel panel-green">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-comments fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                <?php 
                   $comments_count = recordcount('comments');
                ?>      
              <div class='huge'><?php echo $comments_count;?></div>
                  <div>Comments</div>
                </div>
            </div>
        </div>
        <a href="comments.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
 </div>
 <div class="col-lg-3 col-md-6">
    <div class="panel panel-yellow">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                <?php       
                     $users_count =recordcount('users');
                ?>      
                  <div class='huge'><?php echo $users_count;?></div>
                    <div> Users</div>
                </div>
            </div>
        </div>
        <a href="users.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
 </div>
 <div class="col-lg-3 col-md-6">
    <div class="panel panel-red">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-list fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <?php 
                     $categories_count = recordcount('categories');
                  ?>      
                  <div class='huge'><?php echo $categories_count;?></div>
                     <div>Categories</div>
                </div>
            </div>
        </div>
        <a href="categories.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
 </div>
</div>
                <!--/widjet row -->

 <?php 
      
     $publish_posts_count = match_record_count('post','post_status','publish');

     $draft_posts_count = match_record_count('post','post_status','draft');
     
     $UnApproved_comments_count = match_record_count('comments','comment_status','UnApproved');

     $admin_users_count = match_record_count('users','user_role','admin');

     $subscriber_users_count = match_record_count('users','user_role','subscriber');
 
 ?>               

<!-- CHARTS ROW -->
<div class="row">   
   <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'count'],
          <?php 
            $chart_title = array('Posts','Active Posts','Draft Posts','Comments','Blocked Comments','Users','Admin Users','Subscriber Users','Categories');
            $chart_count = array($post_count,$publish_posts_count,$draft_posts_count,$comments_count,$UnApproved_comments_count,$users_count,$admin_users_count,$subscriber_users_count,$categories_count);
            for($i=0;$i<8;$i++){
                echo "['{$chart_title[$i]}',{$chart_count[$i]}],";
            }
          ?>
          // ['Posts', 1000],
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };
       var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
</div>
<div id="columnchart_material" style="width:'95%'; height: 400px;"></div>
<!-- //CHARTS ROW END  -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include 'includes/admin_footer.php';?>
