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

<title>Pull Up a Chair</title>

<?php

  include 'meta.html';

?>


<?php

// Upcoming Show //

NextShowIndex($current_date, $connection_string);
$story_id = 2;

?>

<!-- Body Copy -->

<div id="welcome">

<h1>Welcome!</h1>
<p>A spin on traditional storytelling, Pull Up A Chair will feature spoken stories in addition to stories told using other art forms - including dance, music, burlesque, visual art and more from some of Indy's best artists.</p>

<?php

// Featured Story //

story_details_index($story_id, $connection_string);

?>

<!-- Show News Updates -->

<?php
  view_news($current_date, $connection_string)
?>

</div>

<?php

  include 'footer.php';

?>

</div>
</body>
</html>