<?php
// Start the session
session_start();

// Includes

include_once("connection_string.php");  
include_once("puac_functions.php");  
include_once("functions/index_functions.php");  
include_once("backstage/functions/user_lib.php");  

// Check for errors passed in the URL

if(ISSET($_GET['error'])){

  $error_message = check_error($_GET['error']);

}

if(ISSET($_POST['pass'])){
  $user = new User;
  $user->CheckPassword($connection_string, $_POST['email'], $_POST['pass']);
}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Contact | Pull Up a Chair</title>

<!-- INCLUDE THE SCRIPTS & METADATA -->

<?php
  include 'meta.html';
?>

<?php

// Upcoming Show //

NextShow($current_date, $connection_string);
$story_id = 2;

?>

<div id="welcome">

<title>Contact US: Pull Up a Chair</title>

<?php

//DETERMINE THE CONTENT OF THE PAGE
  if(!ISSET($m)){
    $login = new User;
    $login->LoginUser();
  }


?>

</div>

<!-- INCLUDE THE FOOTER INCLUDING THE NAVIGATION -->

<?php
  include 'footer.php';
?>

</div>
</body>
</html>