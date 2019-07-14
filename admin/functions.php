<?php 
//FUNCTION QUERY CHECKER------------------------------------------------------------------------------
  function querychecker($var){
        global $dbcon;
        if(!$var){
           die("Query Failed// ".mysqli_error($dbcon));
        }
    }
//---------------------------END FUNCTION QUERY CHECKER------------------------------------------

//FUNCTION ESCAPE STIRNG--------------------------------------------------------------------
function escape($string){
  global $dbcon;
  $string = mysqli_real_escape_string($dbcon,$string);
  return $string = trim($string);
} 

//-----------------END FUNCTION ESCAPE STIRNG.-------------------------------------------------------

//FUNCTION USER ONLINE IN ADMIN----------------------------------------------------------------------  
function users_online(){  
if(isset($_GET['onlineusers'])){
 global $dbcon;

  if(!$dbcon){
    session_start();
    include("../includes/dbcon.php");
  
    $session = session_id();
    $time = time();
    $time_out_seconds = 07;
    $time_out = $time-$time_out_seconds;
   
    $query ="SELECT * FROM users_online WHERE session='{$session}' ";//session id identify different browser.
    $checking_users_online_query = mysqli_query($dbcon,$query);
    $count_usersonline = mysqli_num_rows($checking_users_online_query);

    if($count_usersonline==NULL){
       $i_onlineusers = mysqli_query($dbcon,"INSERT INTO users_online(`session`,`time`)VALUES('$session','$time')");
       querychecker($i_onlineusers);
    }else{
        $u_onlineusers = mysqli_query($dbcon,"UPDATE users_online SET time='$time' WHERE `session`='$session'  ");
        querychecker($u_onlineusers);
    }

    $db_usersonline_query =  mysqli_query($dbcon,"SELECT * FROM users_online WHERE time > '$time_out' "); 
    //if time is in active the user is active because based on user session id only time updating so time>timeout else
    //the database time will not be updated time_out will increased and usernot active.
      querychecker($db_usersonline_query);
      $online_count = mysqli_num_rows($db_usersonline_query);
      echo $online_count;

   }//if dbcon checking.   
 }//if isset end.

}//-function online end.

users_online();

//-------------------------------------END FUNCTION USER ONLINE IN ADMIN----------------------------  


//belongs to admin index.
function recordcount($table){
    global $dbcon;
    $query = "SELECT * FROM $table";
    $select_table_query = mysqli_query($dbcon,$query);
    $record_count = mysqli_num_rows($select_table_query);
    querychecker($record_count);
    return $record_count;
}
 //belongs to admin index. 
function match_record_count($table,$matching,$matcher){
     global $dbcon;
     $query = "SELECT * FROM $table WHERE $matching= '$matcher' ";
     $table_query = mysqli_query($dbcon,$query); 
     querychecker($table_query);
     $record_count = mysqli_num_rows($table_query); 
     return $record_count; 
} 
//belongs to fulluse admin section.
function selecttable($table){
    global $dbcon;
    $query = "SELECT * FROM $table";
    $select_table_query = mysqli_query($dbcon,$query);
    querychecker($select_table_query);
    return $select_table_query;
} 


//USER AUTHENTICATION----------------------------------------------------------------------------------
function u_login(){
  if(isset($_SESSION['username'])){
    if($_SESSION['username']){
     return true;
    }
  }
  return false;
}
function is_admin(){
  global $dbcon;
  if(u_login()){
    $username = $_SESSION['username'];
    $query = "SELECT user_role FROM users WHERE username = '$username' ";
    $fetching_userrole = mysqli_query($dbcon,$query);
    querychecker($fetching_userrole);
     $row = mysqli_fetch_assoc($fetching_userrole);
     $user_role = $row['user_role'];     
    if($user_role =='admin'){
      return true;
    }else{
      return false;
    } 
  }     
}

//----------------------------------------END USER AUTHENTICATION---------------------------------------



//USER REGISTRATION-----------------------------------------------------------------------------------
function register_user($firstname,$lastname,$username,$email,$password){
      global $dbcon;
      $firstname = escape(ucfirst(strtolower($firstname)));
      $lastname  = escape(ucfirst(strtolower($lastname))); 
      $username  = escape(ucfirst(strtolower($username)));
      $email     = escape($email); 
      $password = password_hash($password,PASSWORD_BCRYPT,array('cost'=>8));
 
     $query = "INSERT INTO users SET user_firstname='{$firstname}',user_lastname='{$lastname}', username='{$username}',user_email='{$email}',user_password='{$password}',user_role='subscriber' ";
       $registration_query = mysqli_query($dbcon,$query);
       querychecker($registration_query);
       echo "<h4 class='bg-success'>User Registered<a href='index.php'> Login</a></h4>";           
}

function user_exist($username){
   global $dbcon;
   $query = "SELECT username FROM users WHERE username = '$username' ";
   $user_got = mysqli_query($dbcon,$query);
   querychecker($user_got);
   if(mysqli_num_rows($user_got)>0){
     return true;
   }else{
     return false;
   }
}

//--------------------------------------END USER REGISTRATION-------------------------------------


//LOGIN FUNTION--------------------------------------------------------------------------------------
function login($loginname,$loginpassword){
  global $dbcon;
  $login_username =escape(ucfirst(strtolower($loginname)));
  $login_userpassword = escape($loginpassword);   
     //form data if presented in db it run query and fetch record based on username. 
      $query = "SELECT * FROM users WHERE username='{$login_username}' ";
      $check_user_query = mysqli_query($dbcon,$query);
      querychecker($check_user_query);
      while($row = mysqli_fetch_array($check_user_query)){
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_email = $row['user_email'];
        $db_user_role = $row['user_role'];
      }
    //verifying password.
     if(password_verify($login_userpassword,$db_user_password)){
        $_SESSION['userid']    = $db_user_id;
        $_SESSION['username']  = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname']  = $db_user_lastname;
        $_SESSION['userrole']  = $db_user_role;
        header("Location:../admin/index.php"); 
      }else{
        header("Location:../index.php"); 
      }
}

//---------------------------------------END LOGIN FUNTION-----------------------------------------------
?>



                  