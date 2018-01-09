<?php
// Start the session

// Includes

include_once("connection_string.php");  
include_once("puac_functions.php");  
include_once("functions/index_functions.php");  
include_once("functions/story_functions.php");  
include_once("functions/show_lib.php");  
include_once("functions/story_lib.php");  

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

if(ISSET($_GET['story'])){

  $story_number = $_GET['story'];

}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Pull Up a Chair</title>

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

  story_details($story_number, $connection_string);
?>


</div>

<?php

  include 'footer.php';

?>
</body>
</html>