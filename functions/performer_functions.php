<?php

$artist_object = new Artist


function GetPerformer($artist_id, $connection_string){
 
  $performer         = $artist_id;
  $connection_string = $connection_string;
  
  $sql = 'SELECT * FROM `Performers` WHERE `PerformerID` = "'.$performer.'"';
    
  if($result = mysqli_query($connection_string, $sql)){


    while($row = mysqli_fetch_array($result)){
      
      $artist['pfirst_name'] = stripslashes($row['PerformerFirstName']);
      $artist['plast_name']  = stripslashes($row['PerformerLastName']);
      $artist['bio']         = stripslashes($row['PerformerBio']);
    
    }
  }
  else{    
    die('Error: ' . mysqli_error($connection_string));
  }
  
  return $artist;
}
?>