
<table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>User Id</th>
              <th>Username</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Email</th>
              <th>Role</th>
              <th>Admin</th>
              <th>Subscriber</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
       
          <tbody>
  <?php 
   $count=0;
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($dbcon,$query);
    while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
       
        echo "<tr>";
          $count++;
          echo "<td class='text-center'>$count</td>";
          echo "<td>{$username}</td>";
          echo "<td>{$user_firstname}</td>";
          echo "<td>{$user_lastname}</td>";
          echo "<td>{$user_email}</td>";
          echo "<td style='font-weight:bold;'>{$user_role}</td>";
          echo "<td style='text-align:center;font-size:19px;'><a href='users.php?user_role_A={$user_id}'><i style='color:green;' class='fas fa-user-shield'></i></a></td>";
          echo "<td style='text-align:center;font-size:19px;'><a href='users.php?user_role_S={$user_id}'><i style='color:green;' class='fas fa-user'></i></a></td>";
          echo "<td style='text-align:center;font-size:19px;'><a href='users.php?source=edit_users&edit_users_id={$user_id}'><i class='fas fa-edit'></i></a></td> ";
          echo "<td style='text-align:center;font-size:19px;'><a onClick=\"javascript:return confirm('Confirm Delete')\" href='users.php?delete=$user_id'><i class='fas fa-trash'></i></a></td>";
        echo "</tr>";
    }
  ?> 
<!-- after clicking delete it open posts.php?delete parameter in url.
1.click it will delete this but not shown until same page refresh.
2.so header used. -->
  <?php 
     if(isset($_GET['user_role_A'])){
          $user_role_A = $_GET['user_role_A'];
          $query = "UPDATE users SET user_role ='admin' WHERE user_id=$user_role_A";
          //user id getting from the url.
          $user_roleA_query = mysqli_query($dbcon,$query);
          header("Location:users.php");
     }

     if(isset($_GET['user_role_S'])){
          $user_role_S = $_GET['user_role_S'];
          $query = "UPDATE users SET user_role='subscriber' WHERE user_id=$user_role_S";
          $user_roleS_query = mysqli_query($dbcon,$query);
          header("Location:users.php");
     }

     if(isset($_GET['delete'])){
        $delete_user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = $delete_user_id";
        $delete_user_query = mysqli_query($dbcon,$query);  
        header("Location:users.php");
     }  
  ?> 
          </tbody>
</table>
        