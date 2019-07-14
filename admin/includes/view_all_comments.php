

<!-- COMMENT DIAPLAY TABLE DESIGN AND DISPLAYING COMMENTS DYNAMICALLY FROM DB INPUT,

     COMMENT ADDING IN INDEX/POST.PHP
 -->

<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Users</th>
      <th>comment</th>              
      <th>E-mail</th>
      <th>Status</th>
      <th>Related To</th>
      <th>Post Image</th>
      <th>Date</th>
      <th>Publish</th>
      <th>Hidden</th>
      <th>Delete</th>
    </tr>
  </thead>

  <tbody>
      <?php 
      $count=0;
        $user = $_SESSION['username'];
        if(is_admin()){
           $query="SELECT * FROM comments";
        }else{
           $query = "SELECT * FROM comments WHERE comment_user='$user' ORDER BY comment_id DESC";
        }   
        $select_comments = mysqli_query($dbcon,$query);
        while($row = mysqli_fetch_assoc($select_comments)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];//Getting from comment DB.
            $comment_user = $row['comment_user'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            echo "<tr>";
            $count++;
            echo "<td>{$count}</td>";
            echo "<td>{$comment_user}</td>";
            echo "<td>{$comment_content}</td>";                      
            echo "<td>{$comment_email}</td>";
            if($comment_status == 'Approved'){
              $my_comment_status = 'Published';
              echo "<td><b>{$my_comment_status}</b></td>";
            }else{
              $my_comment_status = 'Hidden';
              echo "<td><b>{$my_comment_status}</b></td>"; 
            }
           
              
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
            echo "<td style='vertical-align:middle;'>{$comment_date}</td>";
            echo "<td style='color:red;text-align:center;font-size:19px;vertical-align:middle;'><a href='comments.php?Approve=$comment_id'><i style='color:grey;' class='fas fa-eye'></i></a></td>";
            echo "<td style='text-align:center;font-size:19px;vertical-align:middle;'><a href='comments.php?UnApprove=$comment_id'><i style='color:grey;' class='fas fa-eye-slash'></i></a></td>";
            echo "<td style='text-align:center;font-size:19px;vertical-align:middle;'><a href='comments.php?delete=$comment_id'><i class='fas fa-trash'></i></a></td>";
            echo "</tr>";
        }
      ?> 

  <?php 
    if(isset($_GET['Approve'])){
       $comment_Apporve_id = $_GET['Approve'];
       $query = "UPDATE comments SET comment_status='Approved' WHERE comment_id=$comment_Apporve_id";
       $approval_query = mysqli_query($dbcon,$query);
       header("Location:comments.php");
     }

     if(isset($_GET['UnApprove'])){
       $comment_UnApporve_id = $_GET['UnApprove'];
       $query = "UPDATE comments SET comment_status='UnApproved' WHERE comment_id=$comment_UnApporve_id";
       $approval_query = mysqli_query($dbcon,$query);
       header("Location:comments.php");
     }

     if(isset($_GET['delete'])){
        $comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id=$comment_id";
        $delete_comment_query = mysqli_query($dbcon,$query); 
        header("Location:comments.php"); 
     }  
  ?> 
  </tbody>
</table>
        