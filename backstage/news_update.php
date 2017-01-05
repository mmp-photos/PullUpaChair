<?php

$context = '';

// Includes
include_once("connection_string.php");  
include_once("puac_functions.php");  

// GET show ID from the URL
  if(ISSET($_GET["context"])){
    $context = $_GET["context"];
  }

  if(ISSET($_GET["news_id"], $connection_string)){
  $news_id = $_GET["news_id"];

    $connection_string = $connection_string;

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
if(ISSET($_POST["insert"])){

  $update_title        = $_POST["update_title"];
  $update_text         = $_POST["update_text"];
  $date_added          = date('Y-m-d', strtotime(str_replace('-', '/',$_POST["date_added"])));
  $date_expires        = date('Y-m-d', strtotime(str_replace('-', '/',$_POST["date_expires"])));
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
    header('Location:home.php');
    
}

// Check if form was posted to UPDATE stories in the database
if(ISSET($_POST["update"])){

  $update_title        = $_POST["update_title"];
  $update_text         = $_POST["update_text"];
  $date_added          = date('Y-m-d', strtotime(str_replace('-', '/',$_POST["date_added"])));
  $date_expires        = date('Y-m-d', strtotime(str_replace('-', '/',$_POST["date_expires"])));  
  $status              = $_POST["status"];
  $news_id             = $_POST["news_id"];  

  $sql = sprintf("UPDATE `NewsUpdates` SET UpdateTitle = '%s', UpdateText = '%s', DateAdded = '%s', DateExpires = '%s', Status = '%s' WHERE `UpdateID`= $news_id", 
    
    mysqli_real_escape_string($connection_string,$update_title), 
    mysqli_real_escape_string($connection_string,$update_text), 
    mysqli_real_escape_string($connection_string,$date_added), 
    mysqli_real_escape_string($connection_string,$date_expires), 
    mysqli_real_escape_string($connection_string,$status));
    
  if($result = mysqli_query($connection_string, $sql)){
    header('Location:container.php?action=message&error=0000000002');
    
      } else {
      
    die('Error: ' . mysqli_error($connection_string));

  }

  if(ISSET($_POST["delete"])){

    $status              = 'DLTD';
    $news_id             = $_POST["news_id"];  

    $sql = sprintf("UPDATE `NewsUpdates` SET Status = '%s' WHERE `UpdateID`= $news_id", 
    
    mysqli_real_escape_string($connection_string,$status));
     
    if($result = mysqli_query($connection_string, $sql)){
      header('Location:container.php?error=0000000002');
    
      } else {
      
      die('Error: ' . mysqli_error($connection_string));
    }    
  }
}


switch($context){
  case "add":
    echo '<h1>Add A News Update</h1>';
    echo '<form action="news_update.php" method="POST">';
    echo '<p class="label"><label for="update_title">Headline</label> <input name="update_title" type="text"></p>';
    echo '<p class="label"><label for="date_expires">Date Expires</label> <input type="text" id="datepicker" name="date_expires" value="'.$date_expires.'"></p>';
    echo '<p class="label"><label for="update_text">News Update Information</label> <textarea name="update_text" type="text">'.$update_text.'</textarea></p>';
    echo '<input name="status"     type="hidden" value="AP"></p>';
    echo '<input name="posted"     type="hidden" value="POSTED"></p>';
    echo '<input name="insert"     type="hidden" value="insert"></p>';
    echo '<input name="date_added" type="hidden" value="'.date('d/m/Y').'"></p>';
    echo '</form>';
    break;
    
  case "update":
    echo '<h1>Update Story</h1>';
    echo '<form action="news_update.php" method="POST">';
    echo '<p class="label"><label for="update_title">Headline</label> <input name="update_title" value="'.$update_title.'" type="text"></p>';
    echo '<p class="label"><label for="date_expires">Date Expires</label> <input type="text" id="datepicker" name="date_expires" value="'.$expiration_date.'"></p>';
    echo '<p class="label"><label for="update_text">News Update Information</label> <textarea name="update_text" type="text">'.$update_text.'</textarea></p>';
    echo '<input name="status"  type="hidden" value="AP"></p>';
    echo '<input name="posted"  type="hidden" value="POSTED"></p>';
    echo '<input name="update"  type="hidden" value="update"></p>';
    echo '<input name="news_id" type="hidden" value="'.$news_id.'"></p>';
    echo '<input name="date_added" type="hidden" value="'.date('d/m/Y').'"></p>';
    
    if($context == "update"){
      echo '<input name="story_id" type="hidden" value="'.$news_id.'"></p>';
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
    echo '<h1>'.$update_title.'</h1>';
    echo '<p>Date expires: '.$expiration_date.'</p>';
    echo '<p>'.$update_text.'</p>';
    break;
  default:
    echo '<h3>Invalid Argument</h3>';
}

?>