<?php

// Select Stories and Output details

function story_details($story_number, $connection_string){
  $story = $story_number;
    
  $connection_string2 = $connection_string;

    $sql = 'SELECT * FROM 
           `Stories` 
           LEFT JOIN `Performers` on Stories.Performer = Performers.PerformerID
           LEFT JOIN `ShowInfo` on Stories.ShowID = ShowInfo.ShowID
           WHERE `StoryID` = "'.$story.'"
           LIMIT 1';
    
    if($result = mysqli_query($connection_string2, $sql)){
    
      while($row = mysqli_fetch_array($result)){
      
        $title           = stripslashes($row['StoryName']);
        $show_date       = stripslashes($row['ShowDateTime']);
        $pID             = stripslashes($row['Performer']);
        $description     = stripslashes($row['StoryDescription']);
        $video_link      = stripslashes($row['VideoEmbed']);
        $performer_fname = stripslashes($row['PerformerFirstName']);
        $performer_lname = stripslashes($row['PerformerLastName']);

        $date = strtotime($show_date);
        $formatted_date = date("M d, Y", $date);
        
        $performer_name = $performer_fname.' '.$performer_lname;
      }
    }
    if(ISSET($title)){
      echo '<h1>'.$title.'</h1>';
      
      if(ISSET($performer_name)){
        echo '<p class="performer-name">By: <a href="performer.php?performer='.$pID.'">'.$performer_name.'</a></p>'; 
      }
      echo '<p class="show-date">Show: '.$formatted_date.'</p>';
      echo '<p>'.$description.'</p>';
      echo $video_link;
    }
    else{
      echo "<p>The story could not be found.</p>";
    }
    
}

?>