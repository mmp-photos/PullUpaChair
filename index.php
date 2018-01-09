<?php
// Start the session
session_start();
// Includes

include_once("connection_string.php");  
include_once("functions/index_functions.php");  
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

<!-- Body Copy -->

<div id="welcome">

<h1>Welcome!</h1>
<p>A spin on traditional storytelling, Pull Up A Chair will feature spoken stories in addition to stories told using other art forms - including dance, music, burlesque, visual art and more from some of Indy's best artists.</p>

<?php

// Featured Story //
$story_row = SelectStory($connection_string);
$story_id = '000002';
$story = new Story;
$story->set_name($story_row);
echo '<div class="index_story">';
$story->ShowStory();
echo '</div>';
?>

<!-- Show News Updates -->

<?php
  //view_news($current_date, $connection_string)
?>

</div>

<?php

  include 'footer.php';

?>

</div>
</body>
</html>