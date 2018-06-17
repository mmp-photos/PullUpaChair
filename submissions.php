<?php
// Start the session
session_start();
// Includes

include_once("connection_string.php");  
include_once("functions/index_functions.php");  
include_once("functions/submissions_functions.php");  
include_once("backstage/functions/submission_lib.php");  
include_once("backstage/functions/user_lib.php");  
include_once("functions/show_lib.php");  

//CREATE SHOW OBJECT
$show = new Show;
$show_details = $show->ShowObject($connection_string);
$show->set_name($show_details);
if(!ISSET($_SESSION['show_date'])){
  $_SESSION['show_id']   = $show->show_id;
  $_SESSION['show_date'] = $show->show_date;
}
else{
}

// Check for errors passed in the URL

if(ISSET($_GET['error'])){

  $error_message = check_error($_GET['error']);

}
  
if(ISSET($_POST['posted'])){
  $posted = $_POST;
  $error = submission($posted);

// Insert data into Database //

if(!ISSET($error['edit'])){
  $state = 'insert';
  if($state== 'insert'){
    InsertSubmission($error, $posted, $connection_string, $show_id);
    MailSubmission($error, $posted);
    $state = 'confirm';
  }
}
else{
  $state = '';
}
  

// Determine State of Page to Be Displayed //
if(ISSET($error['edit'])){
  $state = 'edit';
  }
}
else{
  $state = 'input';
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Submissions | Pull Up a Chair</title>

<!-- INCLUDE THE SCRIPTS & METADATA -->

<?php
  include 'meta.html';
?>

<?php

// Upcoming Show //

$show->NextShow($_SESSION['show_date']);
$story_id = 2;

?>

<div id="welcome">

<?php
  
  if($state == "edit"){
    SubmissionErrors($error, $_POST, $show_id);
  }
  elseif($state == 'confirm'){
    VerificationPage($error, $posted);
  }
  elseif($state == 'input'){
    SubmissionForm($show->show_id);
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