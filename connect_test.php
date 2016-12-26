<?php

  $connection_string2 = mysqli_connect("pullupachairindycom.ipagemysql.com","puac_root","pas5W0rd1","puac");

 $sql = 'SELECT * FROM `Stories` 
            LEFT JOIN `Performers` on Stories.Performer = Performers.PerformerID
            LEFT JOIN `ShowInfo` on Stories.ShowID = ShowInfo.ShowID
            ORDER BY `Stories`.`ShowID`, `Stories`.`ShowOrder` ASC';
    
    if($result = mysqli_query($connection_string2, $sql)){
    
    echo '<table>';
        
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
          echo '<tr><td colspan="4"><h1>'.$formatted_date.'</h1></tr>';
        }
        echo '<tr><td><a href="story.php?story='.$story_id.'">'.$first_name.' '.$last_name.'</a></td></tr>';
        $new_show = $show_id;
      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }
    
?>