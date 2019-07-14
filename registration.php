<?php  include "includes/header.php"; ?>
<?php  include "includes/nav.php"; ?>

<?php 
    if(isset($_POST['submit'])){ 
      $firstname = $_POST['firstname'];
      $lastname  = $_POST['lastname']; 
      $username  = $_POST['username'];
      $email     = $_POST['email'];
      $password  = $_POST['password']; 
      
      $error['usererr']='';
      $error['usernameerr']='';
      $error['passerr']='';

         if(strlen($username)<8){
            $error['usererr']='Username Must Be 8 Characters.';
         } 
         if(user_exist($username)){
           $error['usernameerr']='User Already Exist.';
         }      
         if(strlen($password)<8){
           $error['passerr']='Password Must Be 8 Characters.';
         }

          $userlerr = $error['usererr'];
          $usernerr =  $error['usernameerr'];
          $userperr= $error['passerr'];
            
          // if(empty($userlerr&&$usernerr&&$userperr)){
          //   register_user($firstname, $lastname,$username,$email,$password);  
          // }
                             
    }         
?>
<!-- Page Content -->
<div class="container">    
<section id="login">
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <div class="form-wrap">
            <h1 style="margin-bottom:20px;">Registration</h1>
                <form role="form" action="" method="post" id="login-form" 
                       autocomplete="off">
                    <div class="form-group" style="display:flex;">
                      <i style='font-size:30px;padding:0 14px 0 4px;' class='fas fa-user'></i>
                      <div class="form-inline">
                        <label for="firstname" class="sr-only">firstname</label>                         
                        <input type="text" name="firstname" id="firstname" value="<?php if(isset($firstname)){echo $firstname;}?>" class="form-control" placeholder="Firstname" required>

                        <label for="lastname" class="sr-only">lastname</label>
                        <input type="text" name="lastname" id="lastname" value="<?php if(isset($lastname)){echo $lastname;}?>"class="form-control" placeholder="Lastname" required>
                      </div>
                    </div>  

                    <div class="form-group" style="display:flex;">
                        <label for="username" class="sr-only">username</label> 
                        <i style='font-size:30px;padding-right:10px;' class='fas fa-address-card'></i>   
                        <input type="text" name="username" id="username" value="<?php if(isset($username)){echo $username;}?>" class="form-control" placeholder="Enter Desired Username" required>
                    </div>
                     <h6 style='color:red;margin-left:50px;'><?php if(isset($username)){echo $userlerr,$usernerr;}?></h6>
                     <div class="form-group" style="display:flex;">
                        <label for="email" class="sr-only">Email</label>
                        <i style='font-size:30px;padding:0 12px 0 3px;' class='fas fa-envelope'></i>                           
                        <input autocomplete='on' type="email" name="email" id="email" value="<?php if(isset($email)){echo $email;}?>" class="form-control" placeholder="somebody@example.com" required>
                    </div>
                     <div class="form-group" style="display:flex;">
                        <label for="password" class="sr-only">Password</label>
                        <i style='font-size:30px;padding:0 12px 0 3px;' class='fa fa-key'></i>
                        <input type="password" name="password" id="key"value="<?php if(isset($password)){echo $password;}?>" class="form-control" placeholder="Password" required>
                    </div>
                    <h6 style='color:red;margin-left:50px;'><?php if(isset($password)){echo $userperr;}?></h6>
            
                    <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                </form>                
            </div>
        </div> <!-- /.col-xs-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->
</section><hr>

<?php include "includes/footer.php";?>

  