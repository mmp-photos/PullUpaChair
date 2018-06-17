<?php
// Start the session
session_start();
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

//CHECK FOR POST DATA
if(ISSET($_POST['posted'])){

  $password = $_POST['password'];
  $email    = $_POST['email'];
  
  $sql = 'SELECT * FROM `UserAccess` WHERE `UserName` = "'.$email.'"';
    
  if($result = mysqli_query($connection_string, $sql)){
    while($row = mysqli_fetch_array($result)){      
      $hash           = $row['UserPassword'];
      $first_name     = stripslashes($row['UFirstName']);
      $last_name      = stripslashes($row['ULastName']);
      $UserAccess     = stripslashes($row['UserAccess']);
        if (password_verify($password, $hash)){      
          $_SESSION["FirstName"]   = $first_name;
          $_SESSION["LastName"]    = $last_name;
          $_SESSION["UserAccess"]  = $UserAccess;
          setcookie("name", $first_name);
          header('Location:home.php');  
        }
    }  
  }
}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Pull Up a Chair</title>

<?php

  include '../meta.html';

?>


<body>

<div id="box">

<p class="clear">&nbsp;</p>

<div id="center-box">
  <form action="index.php" method="POST">

  <p class="label"><label for="email">Username</label> <input name="email" type="text"></p>
  <p class="label"><label for="password">Password</label> <input name="password" type="password"></p>
  <input name="posted" type="hidden" value="posted"></p>
  
  <?php

  // Print Error Text if it exists

  if(ISSET($error_message)){

  echo $error_message;
  
  } 

  ?>  
  
  <p class="label"><label for="submit"></label> <input name="Submit" type="Submit"></p>
  </form>
</div>


<?php

  include 'footer.php';

?>
</div>
</body>
</html>