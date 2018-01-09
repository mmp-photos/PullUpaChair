<?php
// Start the session

// Includes

include_once("connection_string.php");  
include_once("puac_functions.php");  
include_once("functions/index_functions.php");  

// Check for errors passed in the URL

if(ISSET($_GET['error'])){

  $error_message = check_error($_GET['error']);

}

if(ISSET($_GET['performer'])){
  $performer = $_GET['performer'];
  
}
else{
  $error = 'No performer was selected';
}
?>

<?php
  require_once 'functions/performer_functions.php';
  if(ISSET($performer)){
    $sql = 'SELECT * FROM `Performers` WHERE `PerformerID` = "'.$performer.'"';
    	
    if($result = mysqli_query($connection_string, $sql)){

      while($row = mysqli_fetch_array($result)){
        $performer = new Performer($row);
        $performer->set_name($row);
      }
    }
    $performer_name = $performer->PerformerName();
  }
  else{
    $performer_name = 'Storyteller';
  }
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title><?php echo $performer_name; ?> | Pull Up a Chair</title>

<!-- INCLUDE THE SCRIPTS & METADATA -->

<?php
  include 'meta.html';
?>

<?php

// Upcoming Show //

$show->NextShow($_SESSION['show_date']);
?>

<div id="welcome">

<?php
  echo $performer->PerformerPage();
?>


</div>

<!-- INCLUDE THE FOOTER INCLUDING THE NAVIGATION -->

<?php
  include 'footer.php';
?>

</div>
</body>
</html>