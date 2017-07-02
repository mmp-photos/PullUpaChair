<?php
// Start the session
session_start();

// Includes
include_once("connection_string.php");  
include_once("puac_functions.php");  

// Determine action and context for page

if(ISSET($_GET['action'])){
  $action  = $_GET['action'];
}
  if(ISSET($_GET['context'])){
  $context = $_GET['context'];
}

?>


<!DOCTYPE HTML>
<html>
<head>
  <?php
    include_once("include_header.php");  
  ?>
</head>

<body>

<div id="box">

<p><img src="images/menu.png" alt="navigation" id="mobile_nav" onclick="ShowDiv()"></p>

<div id="turn_off_nav" onclick="HideDiv()">

</div>

<div id="top_nav">
  <?php
    include 'navigation.php';
  ?>
    
</div>

<script>
  document.write(Logo);
</script>

<div id="main_nav">
  <?php
    include 'navigation.php';
  ?>
</div>

<hr>
<div id="center-box">

<?php

switch($action){

  case "show":
    include("show.php");
    break; 
  case "performer":
    include("performer.php");
    break; 
  case "story":
    include("stories.php");
    break; 
  case "news":
    include("news_update.php");
    break;
  case "submissions":
    include("submissions.php");
    break;
  case "message":
    $message_id = $_GET['message_id'];
    output_message($message_id, $connection_string);
    break;
  default;
    echo 'No action is selected';
}

?>
</div>

<?php

  include 'footer.php';

?>
</div>
</body>
</html>