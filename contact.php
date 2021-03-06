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


<p>To contact Pull Up a Chair please email <a href="mailto:indypullupachair@gmail.com">IndyPullUpAChair@gmail.com</a>. or follow us on our social media sites</p>

<p class="center">
<a href="https://www.facebook.com/Pullupachairindy/"><img class="social" src="images/fb.png" alt="Facebook" /></a> 
<a href="https://twitter.com/PullUpAChairInd?lang=en"><img class="social" src="images/tw.png" alt="Twitter" /></a> 
<a href="https://www.instagram.com/pullupachairindy/"><img class="social" src="images/in.png" alt="Instagram" /></a> 
<a href="https://www.youtube.com/channel/UC58OOqq-DYKbwDaHL1PKXOw"><img class="social" src="images/yt.png" alt="YouTube" /></a> 
</p>

  <div id="twitterlist">
    <hr>

    <a class="twitter-timeline" href="https://twitter.com/PullUpAChairInd">Tweets by PullUpAChairInd</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
  </div>

</div>

<!-- INCLUDE THE FOOTER INCLUDING THE NAVIGATION -->

<?php
  include 'footer.php';
?>

</div>
</body>
</html>