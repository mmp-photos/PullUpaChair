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

?>

<?php
  $artist_id = "0000002";
  require_once 'functions/performer_functions.php';
  $artist = GetPerformer($artist_id, $connection_string);
  $artist_name = $artist['pfirst_name'].' '.$artist['plast_name'];
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title><?php echo $artist_name; ?> | Pull Up a Chair</title>

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

<?php
  echo '<h1>'.$artist_name.'</h1>';
?>

</div>

<!-- INCLUDE THE FOOTER INCLUDING THE NAVIGATION -->

<?php
  include 'footer.php';
?>

</div>
</body>
</html>