
<!--INSETING CATEGORIES IN ADMIN PAGE AND VIEWING IT -->
        <!-- Header -->
    
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
                            Welcome to categories
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
<!-- ADD CATEGORY--------------------------------------------------------------------------------------->
      <div class="col-xs-6">
          <!-- FORM ADD category -->
          <form action="" method="post">
             <label for="Add Category">Add Category</label>
             <div class="form-group">
                  <input type="text" class="form-control" name="cat_title" required>
             </div>
             <div class="form-group">
                  <input class="btn btn-primary" type="submit" name="add_category" value="Add Category">  
             </div>
          </form>  
          <?php
               function insert_cat(){
                 global $dbcon;                
                   $cat_title = escape($_POST['cat_title']); 
                   $cat_user_id = $_SESSION['userid'];
                        $query = "INSERT INTO categories(cat_title,cat_user_id)VALUES('$cat_title',$cat_user_id)";
                        $add_categories_query = mysqli_query($dbcon,$query);
                        querychecker($add_categories_query);
               }     
            if(isset($_POST['add_category'])) {
                insert_cat();
            } 
          ?>
<!-- ADD CATEGORY END---------------------------------------------------------------------------------->
       
<!-- UPDATE CATEGORY ------------------------------------------------------------------------------->
 
            <?php    
                  include 'includes/edit_cat.php';  
            ?>
<!-- UPDATE CATEGORY END ------------------------------------------------------------------------------->

      </div>
<!-- col-x6 END 1st -->
        <div class="col-xs-6">
               <table class="table table-borderd table-hover" >
                 <thead>
                   <tr>
                       <th>id</th>
                       <th>Category Title</th>
                   </tr>
                 </thead> 
                 <tbody>
                  <?php  
                      function display_cat(){//DISPLAY CATEGORIES AND OPTIONS.                       
                         global $dbcon;
                          $count=0;
                         $user_id = $_SESSION['userid'];
                         if(is_admin()){
                          $query="SELECT * FROM categories";
                         }else{
                             $query="SELECT * FROM categories WHERE cat_user_id=$user_id";
                         }
                         $category_query = mysqli_query($dbcon,$query);
                         while($row = mysqli_fetch_assoc($category_query)){
                           $cat_id = $row['cat_id'];
                           $cat_title = $row['cat_title'];
                            echo "<tr>";
                            $count++;
                            echo "<td> $count</td>";      
                            echo "<td>$cat_title</td>";                       
                            echo "<td style='border:none;text-align:center'><a href='categories.php?delete={$cat_id}'><i class='fas fa-trash' style='font-size:20px;'></i></a></td>"; 
                            echo "<td style='border:none;'><a href='categories.php?edit={$cat_id}'><i class='fas fa-edit' style='font-size:20px;'></i></a></td>";    
                            echo "</tr>";               
                         }
                      }
                   display_cat(); 
                  ?>
                     
              <!-- ......*/display categories END....... -->
                  <?php                       
                       function delete_cat(){//DELETE CATEGORY                
                           global $dbcon;   
                               $del_cat_id = $_GET['delete'];
                               $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id}";
                               $delete_query = mysqli_query($dbcon,$query);
                               header('location:categories.php');
                       } 
                    if(isset($_GET['delete'])){
                       delete_cat();
                    }   
                  ?>
              <!-- ......*/delete categories END....... -->      
                 </tbody>     
               </table>             
        </div>
     <!-- /.col-xs-6 -->
      </div>
  <!-- /.col-lg-12 -->

    </div>
  <!-- /.row -->

  </div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>

    <!-- /#wrapper -->

<?php include 'includes/admin_footer.php';
