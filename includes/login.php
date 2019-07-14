<?php 
   include 'dbcon.php';
   include '../admin/functions.php';
   session_start();
   if(isset($_POST['login'])){
         $login_name = $_POST['login_name'];
         $login_pass = $_POST['login_password'];
   	  login($login_name,$login_pass);

   }

?>