<?php
// Start the session
session_start();
if(ISSET($_SESSION['FirstName'])){
  $first_name = $_SESSION['FirstName'];
}
else{
 header('Location:index.php');
}

$page_title = 'Backstage: Control Center';

include_once("connection_string.php");  
include_once("functions/user_lib.php");
include_once("functions/submission_lib.php");
include_once("../functions/show_lib.php");

//CREATE SHOW OBJECT AND FIND SHOW ID
$show = new Show;
$show_details = $show->ShowObject($connection_string);
$show->set_name($show_details);
if(!ISSET($_SESSION['show_date'])){
  $_SESSION['show_id']   = $show->show_id;
  $_SESSION['show_date'] = $show->show_date;
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
  <?php
    switch($_SESSION['UserAccess']){
      case "ADMIN":
        echo '<h1>Hello, '.$_SESSION['FirstName'].'!';
        $submissions = new Submission;
        break;
      case "PRFM":
        echo '<h1>Hello, '.$_SESSION['FirstName'].'!';
        $submission = new Submission;
        $submission->ArtistEditSubmission($connection_string, $_SESSION['u'], $_SESSION['show_id']);
        break;
      default:
        echo 'No content loaded.';
    }
  ?>
  </div>
  <?php
    include 'footer.php';
  ?>

  </div>
</body>
</html>