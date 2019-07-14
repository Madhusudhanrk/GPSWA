
<?php
   ob_start();
   session_start(); 
   if(isset($_SESSION['userrole'])){
   	   $_SESSION['userid']=NULL;
   	   $_SESSION['userrole']=NULL;
   	   $_SESSION['username']=NULL;
   	   $_SESSION['user_firstname']=NULL;
   	   $_SESSION['user_lastname']=NULL;
     header("Location:../index.php");	   
   }
?>