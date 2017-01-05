<?php

// Includes
include_once("connection_string.php");  
include_once("puac_functions.php");  

// GET show ID from the URL
  if(ISSET($_GET["context"])){
    $context = $_GET["context"];
  }

  if(ISSET($_GET["story_id"])){
  $story_id = $_GET["story_id"];

    $connection_string = mysqli_connect("localhost","root","pas5W0rd1","puac");

    $sql = 'SELECT * FROM 
           `Stories` 
           WHERE `StoryID` = "'.$story_id.'"
           LIMIT 1';
    
    if($result = mysqli_query($connection_string, $sql)){
        
      while($row = mysqli_fetch_array($result)){
      
        $title           = stripslashes($row['StoryName']);
        $pID             = stripslashes($row['Performer']);
        $show_order      = stripslashes($row['ShowOrder']);
        $description     = stripslashes($row['StoryDescription']);
        $video_link      = stripslashes($row['VideoEmbed']);


      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }

}

// Check if form was posted to add stories to the database
if(ISSET($_POST["posted"])){

  $prefix            = 'ST';
  $show_order        = $_POST["show_order"];
  $story_name        = $_POST["story_name"];
  $show_date         = $_POST["show_date"];
  $performer         = $_POST["performer"];  
  $story_description = $_POST["story_description"];  
  $video_embed       = $_POST["story_video"];  
  $status            = $_POST["status"];  

  $sql = sprintf("INSERT INTO Stories (Prefix,StoryName,ShowID,Performer,StoryDescription,StoryStatus,ShowOrder,VideoEmbed) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s')", 
    
    mysqli_real_escape_string($connection_string,$prefix), 
    mysqli_real_escape_string($connection_string,$story_name), 
    mysqli_real_escape_string($connection_string,$show_date), 
    mysqli_real_escape_string($connection_string,$performer), 
    mysqli_real_escape_string($connection_string,$story_description), 
    mysqli_real_escape_string($connection_string,$status), 
    mysqli_real_escape_string($connection_string,$show_order), 
    mysqli_real_escape_string($connection_string,$video_embed));
    
  if($result = mysqli_query($connection_string, $sql)){
    
    header('Location:home.php');
    
      } else {
      
    die('Error: ' . mysqli_error($connection_string));

  }
    
}

// Check if form was posted to UPDATE stories in the database
if(ISSET($_POST["updated"])){

  $prefix            = 'ST';
  $show_order        = $_POST["show_order"];
  $story_name        = $_POST["story_name"];
  $show_date         = $_POST["show_date"];
  $performer         = $_POST["performer"];  
  $story_description = $_POST["story_description"];  
  $video_embed       = $_POST["story_video"];  
  $status            = $_POST["status"];  
  $story_id          = $_POST["story_id"];  

  $sql = sprintf("UPDATE `Stories` SET Prefix = '%s', StoryName = '%s', ShowID = '%s', Performer = '%s', StoryDescription = '%s', StoryStatus = '%s', ShowOrder = '%s', VideoEmbed = '%s' WHERE `StoryID`= $story_id", 
    
    mysqli_real_escape_string($connection_string,$prefix), 
    mysqli_real_escape_string($connection_string,$story_name), 
    mysqli_real_escape_string($connection_string,$show_date), 
    mysqli_real_escape_string($connection_string,$performer), 
    mysqli_real_escape_string($connection_string,$story_description), 
    mysqli_real_escape_string($connection_string,$status), 
    mysqli_real_escape_string($connection_string,$show_order), 
    mysqli_real_escape_string($connection_string,$video_embed));
    
  if($result = mysqli_query($connection_string, $sql)){
    header('Location:home.php');
    
      } else {
      
    die('Error: ' . mysqli_error($connection_string));

  }
    
}



switch($context){
  case "add":
    echo '<h1>Add Story</h1>';
    echo '<form action="stories.php" method="POST">';
    echo '<p class="label"><label for="story_name">Title</label> <input name="story_name" type="text"></p>';

    // Select Shows For Dropdown Menu

    echo '<p class="label"><label for="show_date">Show Date</label> <select name="show_date">';
    echo '<option value="" SELECTED></option>';
    
    $sql = "SELECT * FROM `ShowInfo`";
    
    if($result = mysqli_query($connection_string, $sql)){
    
      while($row = mysqli_fetch_array($result)){
        $mkdate = strtotime($row['ShowDateTime']);
        echo '<option value="'.$row['ShowID'].'">'.date("M d, Y", $mkdate).'</option>\n';
      }
    }
    else{
      die('Error: ' . mysqli_error($connection_string));
    }
    
    echo '</select></p>';


    // Select Artists For Dropdown Menu

    echo '<p class="label"><label for="performer">Performer</label> <select name="performer">';
    
    $sql = "SELECT * FROM `Performers` WHERE `Status` = 'ACTV' ORDER BY `PerformerFirstName`";
    
    if($result = mysqli_query($connection_string, $sql)){
      while($row = mysqli_fetch_array($result)){
        if(!ISSET($first)){
          echo '<option value=""></option>\n';
          $first = TRUE;
        }
        echo '<option value="'.$row['PerformerID'].'">'.$row['PerformerFirstName'].' '.$row['PerformerLastName'].'</option>\n';
      }
    }
    else{
      $artists = die('Error: ' . mysqli_error($connection_string));
    }
    echo '</select></p>';
    
    echo '<p class="label"><label for="show_order">Show Order</label> <input name="show_order" type="text"></p>';
    echo '<p class="label"><label for="story_description">Story Description</label> <textarea name="story_description" type="text"></textarea></p>';
    echo '<p class="label"><label for="story_video"> Video Embed Link</label> <textarea name="story_video" type="text"></textarea></p>';
    echo '<input name="posted" type="hidden" value="posted"></p>';
    echo '<input name="status" type="hidden" value="ACTV"></p>';
    echo '<p class="label"><label for="submit"></label> <input name="Submit" type="Submit">';
    echo '</form>';
    break;
  case "update":
    echo '<h1>Update Story</h1>';
    echo '<form action="stories.php" method="POST">';
    echo '<p class="label"><label for="story_name">Title</label> <input name="story_name" type="text" value="'.$title.'"></p>';

    // Select Shows For Dropdown Menu

    echo '<p class="label"><label for="show_date">Show Date</label> <select name="show_date">';
    echo '<option value="" SELECTED></option>';
    
    $sql = "SELECT * FROM `ShowInfo`";
    
    if($result = mysqli_query($connection_string, $sql)){
    
      while($row = mysqli_fetch_array($result)){
      
        if($show_id == $row['ShowDateTime']){
          $mkdate = strtotime($row['ShowDateTime']);
          echo '<option value="'.$row['ShowID'].'" SELECTED>'.date("M d, Y", $mkdate).'</option>\n';
        }
        else{
          $mkdate = strtotime($row['ShowDateTime']);
          echo '<option value="'.$row['ShowID'].'" SELECTED>'.date("M d, Y", $mkdate).'</option>\n';
        }
      }
    }
    else{
      die('Error: ' . mysqli_error($connection_string));
    }
    
    echo '</select></p>';


    // Select Artists For Dropdown Menu

    echo '<p class="label"><label for="performer">Performer</label> <select name="performer">';
    
    $sql = "SELECT * FROM `Performers` WHERE `Status` = 'ACTV' ORDER BY `PerformerFirstName`";
    
    if($result = mysqli_query($connection_string, $sql)){
      while($row = mysqli_fetch_array($result)){
        if(!ISSET($first)){
          echo '<option value=""></option>\n';
          $first = TRUE;
        }
        echo '<option value="'.$row['PerformerID'].'">'.$row['PerformerFirstName'].' '.$row['PerformerLastName'].'</option>\n';
      }
    }
    else{
      $artists = die('Error: ' . mysqli_error($connection_string));
    }
    echo '</select></p>';
    
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