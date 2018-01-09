<?php
// Start the session

// Includes

include_once("connection_string.php");  
include_once("functions/index_functions.php");  
include_once("functions/performer_functions.php");
include_once("functions/story_lib.php");

if(ISSET($_GET['error'])){
  $error_message = check_error($_GET['error']);
}

//CHECK FOR SHOW DATE

if(ISSET($_SESSION['show_date'])){

}else{
//CREATE SHOW OBJECT
  require_once("functions/show_lib.php");
  $show = new Show;
  $show_details = $show->ShowObject($connection_string);
  $show->set_name($show_details);
  if(!ISSET($_SESSION['show_date'])){
    $_SESSION['show_id']   = $show->show_id;
    $_SESSION['show_date'] = $show->show_date;
  }else{
  }
}
// Check for errors passed in the URL

if(ISSET($_GET['error'])){
  $error_message = check_error($_GET['error']);
}
if(ISSET($_GET['performer'])){
  $sql = 'SELECT * FROM `Performers` WHERE `PerformerID` = "'.$_GET['performer'].'"';
  if($result = mysqli_query($connection_string, $sql)){
    while($row = mysqli_fetch_array($result)){
      $performer = new Performer($row);
      $performer->set_name($row);
      $performer_name = $performer->PerformerName();
    }
  }
}else{
  $performer_name = 'Storytellers';
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>
<?php
  echo $performer_name;
?>
 | Pull Up a Chair</title>

<!-- INCLUDE THE SCRIPTS & METADATA -->

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

  if($performer_name == "Storytellers"){
    $result = GetAllPerformers($connection_string);
    while($row = mysqli_fetch_array($result)){
      $artist = new Performer;
      $artist->set_name($row);
      $artist->PerformerList();
    }
  }else{
    echo '<div class="performer">';
    $performer->PerformerPhoto();
    $performer->PerformerPage();
    $links = PerformerLinks($_GET['performer'], $connection_string);
    $performer->DisplayLinks($links);
    $result = SelectStoryByPerformer($_GET['performer'], $connection_string);
    while($row = mysqli_fetch_array($result)){
      $story = new Story;
      $story->set_name($row);
      $story->ShowStory();
    }
    echo '</div>';
  }
  
?>

</div>

<!-- INCLUDE THE FOOTER INCLUDING THE NAVIGATION -->

<?php
  include 'footer.php';
?>

</div>
</body>
</html>