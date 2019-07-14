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
                            welcome to admin
                            <small>Author</small>
                        </h1>
           
<!-- COMMENT DIAPLAY TABLE DESIGN AND DISPLAYING COMMENTS DYNAMICALLY FROM DB INPUT,

     COMMENT ADDING IN INDEX/POST.PHP
 -->

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>comment</th>              
      <th>E-mail</th>
      <th>Status</th>
      <th>Related To</th>
      <th>Post Image</th>
      <th>Date</th>
      <th>Approved</th>
      <th>UnApproved</th>
      <th>Delete</th>
    </tr>
  </thead>

  <tbody>
      <?php 
        $post_id = $_GET['cpost_id'];
        $post_id = mysqli_real_escape_string($dbcon,$post_id);
         
        $query = "SELECT * FROM comments WHERE comment_post_id=$post_id";
        $select_comments = mysqli_query($dbcon,$query);
        while($row = mysqli_fetch_assoc($select_comments)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];//Getting from comment DB.
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";                      
            echo "<td>{$comment_email}</td>"; 
            echo "<td><b>{$comment_status}</b></td>";
              
         $query ="SELECT * FROM post WHERE post_id=$comment_post_id";
         //comparing comment_post_id inserted in db  to post_id in posts db to fetch posts data.
         $index_comment_post_id_query = mysqli_query($dbcon,$query);
         while($row = mysqli_fetch_assoc($index_comment_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_image = $row['post_image'];
             echo "<td><a href='../post.php?post_id=$post_id'>$post_title</a></td>";
             echo "<td><img width='100px' src='../images/$post_image'> </td>";
         }
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='post_related_comments.php?Approve=$comment_id'>Approve</a></td>";
            echo "<td><a href='post_related_comments.php?UnApprove=$comment_id'>UnApprove</a></td>";
            echo "<td><a href='post_related_comments.php?delete=$comment_id&cpost_id={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }
      ?> 

  <?php 
    if(isset($_GET['Approve'])){
       $comment_Apporve_id = $_GET['Approve'];
       $query = "UPDATE comments SET comment_status='Approved' WHERE comment_id=$comment_Apporve_id";
       $approval_query = mysqli_query($dbcon,$query);
       header("Location:post_related_comments.php");
     }

     if(isset($_GET['UnApprove'])){
       $comment_UnApporve_id = $_GET['UnApprove'];
       $query = "UPDATE comments SET comment_status='UnApproved' WHERE comment_id=$comment_UnApporve_id";
       $approval_query = mysqli_query($dbcon,$query);
       header("Location:post_related_comments.php");
     }

     if(isset($_GET['delete'])){
        $comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id=$comment_id";
        $delete_comment_query = mysqli_query($dbcon,$query); 
        header("Location:post_related_comments.php?cpost_id={$post_id}"); 
        //just attaching get data for not loosing get data
     }  
  ?> 
  </tbody>
</table>
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
