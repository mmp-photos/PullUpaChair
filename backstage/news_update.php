<?php

// Includes
include_once("connection_string.php");  
include_once("puac_functions.php");  

// GET show ID from the URL
  if(ISSET($_GET["context"])){
    $context = $_GET["context"];
  }

  if(ISSET($_GET["news_id"])){
  $news_id = $_GET["news_id"];

    $connection_string = mysqli_connect("localhost","root","pas5W0rd1","puac");

    $sql = 'SELECT * FROM 
           `NewsUpdates` 
           WHERE `UpdateID` = "'.$news_id.'"
           LIMIT 1';
    
    if($result = mysqli_query($connection_string, $sql)){
        
      while($row = mysqli_fetch_array($result)){
      
        $update_title     = stripslashes($row['UpdateTitle']);
        $update_text      = stripslashes($row['UpdateText']);
        $date_added       = stripslashes($row['DateAdded']);
        $expiration_date  = stripslashes($row['DateExpires']);
        $status           = stripslashes($row['Status']);

      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }

}

// Check if form was posted to add stories to the database
if(ISSET($_POST["posted"])){

  $update_title        = $_POST["update_title"];
  $update_text         = $_POST["update_text"];
  $date_added          = date('Y-m-d', strtotime(str_replace('-', '/',$_POST["date_added"]));
  $date_expires        = date('Y-m-d', strtotime(str_replace('-', '/',$_POST["date_expired"]));
  $status              = $_POST["status"];  

  $sql = sprintf("INSERT INTO NewsUpdates (UpdateTitle,UpdateText,DateAdded,DateExpires,Status) VALUES ('%s','%s','%s','%s','%s')", 
    
    mysqli_real_escape_string($connection_string,$update_title), 
    mysqli_real_escape_string($connection_string,$update_text), 
    mysqli_real_escape_string($connection_string,$date_added), 
    mysqli_real_escape_string($connection_string,$date_expires), 
    mysqli_real_escape_string($connection_string,$status));
    
  if($result = mysqli_query($connection_string, $sql)){
    
    header('Location:home.php');
    
      } else {
      
    die('Error: ' . mysqli_error($connection_string));

  }
    
}

// Check if form was posted to UPDATE stories in the database
if(ISSET($_POST["updated"])){

  $update_title        = $_POST["update_title"];
  $update_text         = $_POST["update_text"];
  $date_added          = date('Y-m-d', strtotime(str_replace('-', '/',$_POST["date_added"]));
  $date_expires        = date('Y-m-d', strtotime(str_replace('-', '/',$_POST["date_expired"]));
  $status              = $_POST["status"];  
  $news_id             = $_POST["news_id"];  

  $sql = sprintf("UPDATE `NewsUpdates` SET UpdateTitle = '%s', UpdateText = '%s', DateAdded = '%s', DateExpires = '%s', Status = '%s' WHERE `StoryID`= $news_id", 
    
    mysqli_real_escape_string($connection_string,$update_title), 
    mysqli_real_escape_string($connection_string,$update_text), 
    mysqli_real_escape_string($connection_string,$date_added), 
    mysqli_real_escape_string($connection_string,$date_expired), 
    mysqli_real_escape_string($connection_string,$status));
    
  if($result = mysqli_query($connection_string, $sql)){
    header('Location:home.php');
    
      } else {
      
    die('Error: ' . mysqli_error($connection_string));

  }
    
}



switch($context){
  case "add":
    echo '<h1>Add A News Update</h1>';
    echo '<form action="news_update.php" method="POST">';
    echo '<p class="label"><label for="update_title">Headline</label> <input name="updated_title" type="text"></p>';
    echo '<p class="label"><label for="date_expires">Headline</label> <input name="date_expires" type="text"></p>';
    echo '<p class="label"><label for="update_text">Story Description</label> <textarea name="update_text" type="text"></textarea></p>';
    echo '<input name="status" type="hidden" value="ACTV"></p>';
    echo '<input name="status" type="date_added" value="'.date('d/m/Y').'"></p>';
    echo '<p class="label"><label for="submit"></label> <input name="Submit" type="Submit">';
    echo '</form>';
    break;
    
  case "update":
    echo '<h1>Update Story</h1>';
    echo '<form action="stories.php" method="POST">';
    echo '<p class="label"><label for="story_name">Title</label> <input name="story_name" type="text" value="'.$title.'"></p>';
    echo '<p class="label"><label for="show_order">Show Order</label> <input name="show_order" type="text" value="'.$show_order.'"></p>';
    echo '<p class="label"><label for="story_description">Story Description</label> <textarea name="story_description" type="text">'.$description.'</textarea></p>';
    echo '<p class="label"><label for="story_video"> Video Embed Link</label> <textarea name="story_video" type="text">'.$video_link.'</textarea></p>';
    
    if($context == "update"){
      echo '<input name="story_id" type="hidden" value="'.$story_id.'"></p>';
      echo '<input name="updated" type="hidden" value="update"></p>';
      echo '<input name="status" type="hidden" value="ACTV"></p>';
    }
    else{
      echo '<input name="posted" type="hidden" value="update"></p>';
      echo '<input name="status" type="hidden" value="ACTV"></p>';    
    }
    echo '<p class="label"><label for="submit"></label> <input name="Submit" type="Submit">';
    echo '</form>';
    break;
  case "view":
    echo '<h1>'.$pfirst_name.' '.$plast_name.'</h1>';
    echo '<p>'.$bio.'</p>';
    break;
  default:
    echo '<h3>Invalid Argument</h3>';
}

?>