<?php

// Includes
include_once("connection_string.php");  
include_once("puac_functions.php");  

// Check if form was posted to add performers to the database
if(ISSET($_POST["posted"])){

  $first_name = $_POST["first_name"];
  $last_name  = $_POST["last_name"];
  $artist_bio = $_POST["artist_bio"];  
  $status     = $_POST["status"];  

  $sql = sprintf("INSERT INTO Performers (PerformerID,PerformerFirstName,PerformerLastName,PerformerBio,Status) VALUES (NULL,'%s','%s','%s','%s')", 
    
    mysqli_real_escape_string($connection_string,$first_name), 
    mysqli_real_escape_string($connection_string,$last_name), 
    mysqli_real_escape_string($connection_string,$artist_bio),
    mysqli_real_escape_string($connection_string,$status));
    
  if($result = mysqli_query($connection_string, $sql)){
    
    header('Location:home.php');
    
      } else {
      
    die('Error: ' . mysqli_error($connection_string));

  }
    
}

if(ISSET($_GET["performer"])){
  $performer = $_GET["performer"];
    
    $sql = 'SELECT * FROM `Performers` WHERE `PerformerID` = "'.$performer.'"';
    
    if($result = mysqli_query($connection_string, $sql)){
        
      while($row = mysqli_fetch_array($result)){
      
        $pid             = stripslashes($row['PerformerID']);
        $pfirst_name     = stripslashes($row['PerformerFirstName']);
        $plast_name      = stripslashes($row['PerformerLastName']);
        $bio     = stripslashes($row['PerformerBio']);

      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }

}

switch($context){
  case "add":
    echo '<h1>Add Performer</h1>';
    echo '<form action="performer.php" method="POST">';
    echo '<p class="label"><label for="first_name">First Name</label> <input name="first_name" type="text"></p>';
    echo '<p class="label"><label for="last_name">Last Name</label> <input name="last_name" type="text"></p>';
    echo '<p class="label"><label for="artist_bio">Artist Bio</label> <textarea name="artist_bio" type="text"></textarea></p>';
    echo '<input name="posted" type="hidden" value="posted"></p>';
    echo '<input name="status" type="hidden" value="ACTV"></p>';
    echo '<p class="label"><label for="submit"></label> <input name="Submit" type="Submit">';
    echo '</form>';
    break;
  case "view":
    echo '<h1>'.$pfirst_name.' '.$plast_name.'</h1>';
    if($bio != ""){
      echo '<p>'.$bio.'</p>';
    }
    else{
      echo '<p>No bio for this artist,</p>';
    }
    break;
  case "update":
    echo '<h1><input name="first_name" value="'.$pfirst_name.'"type="text"> <input name="last_name" value="'.$plast_name.'" type="text"></h1>';
    echo '<p><textarea name="artist_bio" type="text">'.$bio.'</textarea></p>';
    echo '<input name="performer_id" type="hidden" value="'.$pid.'"></p>';
    echo '<p class="label"><label for="submit"></label> <input name="Submit" type="Submit">';
    break;
  default:
    echo '<h3>Invalid Argument</h3>';
}
  
?>
