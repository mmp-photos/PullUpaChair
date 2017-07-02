<?php

// Define Session Variables

if(ISSET($_SESSION["UserAccess"])){
  $first_name  = $_SESSION["FirstName"];
  $last_name   = $_SESSION["LastName"];
  $user_access = $_SESSION["UserAccess"];
  }

// Check Access and Redirect if not an Admin User

function verify_access($user_access){

  switch($user_access){
    case "ADMIN":
     break;
    default:
     header('Location:index.php?error=0000000001');
  }
}

// Check URL for error code

function check_error($check_error, $connection_string){

  $connection_string = $connection_string;
  $error_number      = $check_error;

  $sql = 'SELECT * FROM `Errors` WHERE `ErrorKey` = "'.$error_number.'"';
    
  $result = mysqli_query($connection_string, $sql);
    
    while($row = mysqli_fetch_array($result)){
        
      $error_text = stripslashes($row['ErrorText']);
    }
      return $error_text;
}

// Select all active artists

function select_active_performers(){

  $connection_string = mysqli_connect("localhost","puac","puac_pass","puac");
    
    $sql = 'SELECT * FROM `Performers`';
    
    if($result = mysqli_query($connection_string, $sql)){
        
      while($row = mysqli_fetch_array($result)){
      
        $artists[] = $row;
      }
  
    }else{
    
       $artists = die('Error: ' . mysqli_error($connection_string));
       return $artists;

    }
    

}

// Check for Script Message
function output_message($message_id, $connection_string){

  $connection_string = $connection_string;
  $message_id        = $message_id;
  
  $sql = 'SELECT * FROM `Errors` WHERE `ErrorKey` = "'.$message_id.'"';
    
  $result = mysqli_query($connection_string, $sql);
    
    while($row = mysqli_fetch_array($result)){
        
      echo stripslashes($row['ErrorText']);
    }
}


// Select Stories and Output details

function story_details($story_id){
  $story = $story_id;
    
    $connection_string = mysqli_connect("localhost","root","pas5W0rd1","puac");

    $sql = 'SELECT * FROM 
           `Stories` 
           LEFT JOIN `Performers` on Stories.Performer = Performers.PerformerID
           LEFT JOIN `ShowInfo` on Stories.ShowID = ShowInfo.ShowID
           WHERE `StoryID` = "'.$story.'"
           LIMIT 1';
    
    if($result = mysqli_query($connection_string, $sql)){
        
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
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
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

function story_details2($story_id){
  $story = $story_id;
    
    $connection_string = mysqli_connect("localhost","root","pas5W0rd1","puac");

    $sql = 'SELECT * FROM 
           `Stories` 
           LEFT JOIN `Performers` on Stories.Performer = Performers.PerformerID
           LEFT JOIN `ShowInfo` on Stories.ShowID = ShowInfo.ShowID
           WHERE `StoryID` = "'.$story.'"
           LIMIT 1';
    
    if($result = mysqli_query($connection_string, $sql)){
        
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
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }


    if(ISSET($title)){
      echo '<h2>'.$title.'</h2>';
      echo '<p class="show-date">Show: '.$formatted_date.'</p>';
      echo '<p>'.$description.'</p>';
      echo $video_link;
    }
    else{
      echo "<p>The story could not be found.</p>";
    }
    
}

function story_details_index($story_id){
  $story = $story_id;
    
    $connection_string = mysqli_connect("localhost","root","pas5W0rd1","puac");

    $sql = 'SELECT * FROM 
           `Stories` 
           LEFT JOIN `Performers` on Stories.Performer = Performers.PerformerID
           LEFT JOIN `ShowInfo` on Stories.ShowID = ShowInfo.ShowID
           WHERE `VideoEmbed` != ""
           ORDER BY RAND() LIMIT 1';
    
    if($result = mysqli_query($connection_string, $sql)){
        
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
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }


    if(ISSET($title)){
      echo '<h1>Featured Story</h1>';
      echo $video_link;
      
      if(ISSET($performer_name)){
        echo '<p class="performer-name">By: <a href="performer.php?performer='.$pID.'">'.$performer_name.'</a></p>'; 
      }
      echo '<p class="show-date">Show: '.$formatted_date.'</p>';
    }
    else{
      echo "<p>The story could not be found.</p>";
    }
    
}

// Select Stories and Output details

function show_order($show_id){
  $show = $show_id;
    
    $new_show = 'x';
    $connection_string = mysqli_connect("localhost","root","pas5W0rd1","puac");

    $sql = 'SELECT * FROM `Stories` 
            LEFT JOIN `Performers` on Stories.Performer = Performers.PerformerID
            LEFT JOIN `ShowInfo` on Stories.ShowID = ShowInfo.ShowID
            ORDER BY `Stories`.`ShowID`, `Stories`.`ShowOrder` ASC';
    
    if($result = mysqli_query($connection_string, $sql)){
    
    echo '<table class="backstage">';
        
      while($row = mysqli_fetch_array($result)){
        $story_id   = $row['StoryID'];
        $title      = $row['StoryName'];
        $show_id    = $row['ShowID'];
        $show_order = $row['ShowOrder'];
        $first_name = $row['PerformerFirstName'];
        $last_name  = $row['PerformerLastName'];

        $show_date       = stripslashes($row['ShowDateTime']);
        $date = strtotime($show_date);
        $formatted_date = date("M d, Y", $date);
        
        if($new_show == $show_id){
          
        }else{
          echo '<tr><td colspan="4"><h2>'.$formatted_date.'</h2></tr>';
        }
        echo '<tr><td>'.$show_order.'</td><td>'.$title.'</td><td>'.$first_name.' '.$last_name.'</td><td><a href="container.php?action=story&story_id='.$story_id.'&context=update">Update</a></td><td><td><a href="../story.php?story='.$story_id.'">View</a></td></tr>';
        $new_show = $show_id;
      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }
    echo '</table>';
}

// Show News Updates

function current_news($current_date, $connection_string){
    
    $current_date = $current_date;
    $connection_string = $connection_string;

    $sql = 'SELECT * FROM 
           `NewsUpdates` 
           WHERE `DateExpires` > '.$current_date;
    
    if($result = mysqli_query($connection_string, $sql)){
        
      while($row = mysqli_fetch_array($result)){
      
        $update_title     = stripslashes($row['UpdateTitle']);
        $update_text      = stripslashes(nl2br($row['UpdateText']));
        $date_added       = stripslashes($row['DateAdded']);
        $expiration_date  = stripslashes($row['DateExpires']);
        $status           = stripslashes($row['Status']);
        
        echo '<h2>'.$update_title.'</h2>';
        echo '<p>'.$update_text.'</p>';

      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }

}

// Update News Stories

function update_news($current_date, $connection_string){
    
    $current_date = $current_date;
    $connection_string = $connection_string;

    $sql = 'SELECT * FROM 
           `NewsUpdates` 
           WHERE `DateExpires` > '.$current_date;
    
    if($result = mysqli_query($connection_string, $sql)){
        
      while($row = mysqli_fetch_array($result)){
      
        $update_id        = stripslashes($row['UpdateID']);
        $update_title     = stripslashes($row['UpdateTitle']);
        $update_text      = stripslashes(nl2br($row['UpdateText']));
        $date_added       = stripslashes($row['DateAdded']);
        $expiration_date  = stripslashes($row['DateExpires']);
        $status           = stripslashes($row['Status']);
        
        echo '<p><a class="news" href="container.php?action=news&context=update&news_id='.$update_id.'">'.$update_title.'</a></p>';
      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }

}

// View News Stories

function view_news($current_date, $connection_string){
    
    $current_date = $current_date;
    $connection_string = $connection_string;

    $sql = 'SELECT * FROM 
           `NewsUpdates` 
           WHERE `DateExpires` > '.$current_date;
    
    if($result = mysqli_query($connection_string, $sql)){
        
      while($row = mysqli_fetch_array($result)){
      
        $update_id        = stripslashes($row['UpdateID']);
        $update_title     = stripslashes($row['UpdateTitle']);
        $update_text      = stripslashes(nl2br($row['UpdateText']));
        $date_added       = stripslashes($row['DateAdded']);
        $expiration_date  = stripslashes($row['DateExpires']);
        $status           = stripslashes($row['Status']);
        
        echo '<h2>'.$update_title.'</h2>';
        echo '<p class="news-update">'.$update_text.'</p>';
      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }

}
?>