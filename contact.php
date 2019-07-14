<?php  include "includes/header.php"; ?>
<?php  include "includes/nav.php"; ?>

<?php 
    if(isset($_POST['submit'])){ 
      
      $to  = 'madhusudhandummy@gmail.com';
      $subject = $_POST['subject'];
      $feedback = $_POST['feedback'];
      $header = "From:".$_POST['cemail'];
      mail($to,$subject,$feedback,$header);
  }
?>
<!-- Page Content -->
<div class="container">    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 style="margin-bottom:20px;">Contact:</h1>
                 
                    <form role="form" action="" method="post" id="login-form" 
                           autocomplete="off">
                      
                         <div class="form-group" style="display:flex;">
                            <label for="Subject" class="sr-only">Subject</label>
                                                       
                            <input type="text" name="subject" id="" class="form-control" placeholder="Enter Subject" required>
                        </div>
                         
                         <div class="form-group">
                             <textarea class="form-control" name="feedback" id="" cols="30" rows="10">
                               
                             </textarea>
                        </div>
                        <div class="form-group" style="display:flex;">
                            <label for="email" class="sr-only">Email</label>
                           
                            <input type="email" name="cemail" id="" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>                
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section><hr>

<?php include "includes/footer.php";?>
