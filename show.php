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

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Shows | Pull Up a Chair</title>

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

    // Show History //
    $story_id = TRUE;
    show_order($story_id, $connection_string);
 
  ?>

</div>

<?php

  include 'footer.php';

?>
</div>
</body>
</html>