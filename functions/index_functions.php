<?php

function next_show($current_date, $connection_string){

    
    $current_date = date('Y-m-d h:i:s');
    $connection_string2 = $connection_string;

    $sql = 'SELECT * FROM ShowInfo
            WHERE ShowDateTime > CURRENT_TIMESTAMP';
    
    if($result = mysqli_query($connection_string2, $sql)){
             
      while($row = mysqli_fetch_array($result)){
        $show_name       = $row['ShowName'];
        $show_date       = stripslashes($row['ShowDateTime']);
        $date            = strtotime($show_date);
        $formatted_month = date("F", $date);
        $formatted_day   = date("d", $date);
        
        echo '<p class="calendar_day">'.$formatted_day.'</p>';
        echo '<p class="calendar_month">'.$formatted_month.'</p>';

      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }

}

function NextShowIndex($current_date, $connection_string){

  $current_date = date('Y-m-d h:i:s');
  $connection_string2 = $connection_string;

  $sql = 'SELECT * FROM ShowInfo
          WHERE ShowDateTime > CURRENT_TIMESTAMP';
  
  if($result2 = mysqli_query($connection_string2, $sql)){

  }else{
     
    die('Error: ' . mysqli_error($connection_string));
 
  }
  
    
  while($row2 = mysqli_fetch_array($result2)){
    if($row2['ShowDateTime'] !== ''){
      echo '<div id="show_box_index">';
      echo '<div id="upcoming_index">';
      echo '<p class="next_show">Next Show</p>';
      $formatted_date = next_show($current_date, $connection_string);
      echo '</div>';
      // COMMENTING OUT THE SUBMISSION LINE --->   echo '<p><a class="submission" href="submissions.php">Submit A Story</a></p>';
      // COMMENTING OUT THE TICKET LINE     --->   echo '<p class="tickets"><a class="submission" href="http://www.brownpapertickets.com/event/3040850">Tickets</a></p>';
      echo '</div>';
    }
  }
}

function TicketLink($current_date, $connection_string){
    $current_date = date('Y-m-d h:i:s');
    $connection_string2 = $connection_string;

    $sql = 'SELECT * FROM ShowInfo
            WHERE ShowDateTime > CURRENT_TIMESTAMP';
    
    if($result = mysqli_query($connection_string2, $sql)){
             
      while($row = mysqli_fetch_array($result)){
        $ticket_link     = $row['TicketLink'];

        echo '<li><a class="nav" inhref="'.$ticket_link.'">Tickets</a></li>';

      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }
}

?>