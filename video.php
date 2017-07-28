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

<title>Videos | Pull Up a Chair</title>

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

  <h1>Video</h1>
  <p>See video of all the great acts at the kickoff of the first Pull Up a Chair show!  Individual videos are available on our <a href="https://www.youtube.com/channel/UC58OOqq-DYKbwDaHL1PKXOw">Youtube</a> channel.  Please like and comment on our videos and subscribe for updates.</p>
  <h2>Show #1</h2>
  <p>
  <iframe class="video" src="https://www.youtube.com/embed/videoseries?list=PLS8a3WeVH8d_YQYUzSMithjgumSLxe4q6" frameborder="0" allowfullscreen></iframe>
  </p>

  <h2>Show #2 &ndash; October 16, 2016</h2>
  <p>
  <iframe class="video" src="https://www.youtube.com/embed/videoseries?list=PLS8a3WeVH8d9ZHMm20Hf5RAgMq6TFYh69" frameborder="0" allowfullscreen></iframe></p>

</div>

<?php

  include 'footer.php';

?>

</div>
</body>
</html>