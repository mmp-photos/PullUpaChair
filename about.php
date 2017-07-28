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

<title>About | Pull Up a Chair</title>

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

<h1>Pull Up a Chair</h1>

<img class="about" src="images/about_portrait.jpg" alt="Nikki" />
<p>Pull Up A Chair is the brain baby of an Indianapolis performer of burlesque, theatre and shenanigans. Whether as Nikki or Frankie, she has an passion for art and love of a good story.</p>

<p>Nikki is a Stage Manager so producing a show seemed the next, logical step.
Frankie is a performer and couldn't imagine anyone else hosting and being the face of the show.</p>

<p>Both sides of her are so thankful and the Indy art community for giving this little experiment a shot. The support has been overwhelming.</p>

</div>

<!-- INCLUDE THE FOOTER INCLUDING THE NAVIGATION -->

<?php
  include 'footer.php';
?>

</div>
</body>
</html>