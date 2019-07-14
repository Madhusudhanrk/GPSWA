<!-- FORM EDIT category -->

<?php 
     if(isset($_GET['edit'])){
        $cat_id = $_GET['edit'];
        $query ="SELECT * FROM categories WHERE cat_id = $cat_id";
        $edit_category_query = mysqli_query($dbcon,$query);
        querychecker($edit_category_query);
        while($row = mysqli_fetch_assoc($edit_category_query)){
           $cat_id = $row['cat_id'];
           $cat_title = $row['cat_title'];
        }
     }
?>

<?php
    if(isset($_POST['edit_category'])){
       $update_cat_title = escape($_POST['cat_title']);
       $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id ={$cat_id}";
       $update_category_query = mysqli_query($dbcon,$query);
       querychecker($update_category_query);
       header("Location:categories.php?edit={$cat_id}");
     }
?>
<?php if(isset($_GET['edit'])){ ?>
<form action="" method="post">
   <div class="form-group"> 
    <label for="cat-title">EDIT Category</label>
    <div class="form-group">
        <input value="<?php if(isset($_GET['edit'])){echo $cat_title;}?>" type="text" class="form-control" name="cat_title" required>
    </div>
    <div class="form-group">  
        <input class="btn btn-primary" type="submit" name="edit_category" value="UPDATE Category"> 
    </div> 
   </div>                      
</form>  
<?php } ?> 
<!-- ----*/EDIT----> 