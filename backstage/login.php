<?php
// Start the session
session_start();

//LOGOUT USER
if(ISSET($_GET['action'])){
  if($_GET['action'] == 'logout'){
    $_SESSION = array();
    session_destroy();
  }
}
// Includes

include_once("connection_string.php");  
include_once("functions/user_lib.php");  

// Check for errors passed in the URL

if(ISSET($_GET['error'])){
  $error_message = check_error($_GET['error']);
}
else{
  $error_message = "";
}

//CHECK FOR POST DATA
if(ISSET($_POST['a'])){  
  switch($_POST['a']){
    case "login":
      $user = new User;
      $user->CheckPassword($connection_string, $_POST['email'], $_POST['password']);
      break;
    case "SetPassword":
ew      $user = new User;
      $user->ResetPassword($connection_string, $_POST['u'], $_POST['pass1'], $_POST['pass2']);
      break;
  }
}

//CHECK FOR GET DATA
if(ISSET($_GET['u'])){
  $u = $_GET['u'];
}
else{
  $u = '';
}
if(ISSET($_GET['m'])){
  $mode = $_GET['m'];
}
else{
  $mode = '';
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Pull Up a Chair</title>
<?php
  include 'meta.html';
?>

<body>

<div id="box">

<p class="clear">&nbsp;</p>

<div id="center-box">
<?php
  switch($mode){
    case "add":
      $user = new User;
      $user->PasswordForm($connection_string, $_GET['u']);
      break;
    default:
      LoginForm($error_message);
  }
?>

</div>


<?php

  include 'footer.php';

?>
</div>
</body>
</html>