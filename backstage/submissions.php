<?php

// Includes
include_once("connection_string.php");  
include_once("functions/submissions_functions.php");  

// Select all Submissions by Show

$show_id = GetShowID($current_date, $connection_string);

if(ISSET($_GET['context'])){

  $context = $_GET['context'];
  
}

else {
  
  echo 'Error: 0000000004 – No context is selected';
  die;
  
}

if($context == "view"){

  $sql = 'SELECT * FROM Submissions
          WHERE show_id = "'.$show_id.'" 
          AND status != "DLTD"';
                
  if($result = mysqli_query($connection_string, $sql)){
      
    echo '<h1>Submissions</h1>';
      
    $rowcount=mysqli_num_rows($result);
     
    if($rowcount > 0){

      echo '<table>';
      
      while($row = mysqli_fetch_array($result)){
        switch($row['status']){
          case "SB":
            $color = 'submitted';
          break; 
          case "AP":
            $color = 'approved';
          break; 
        }

        echo '<tr class="'.$color.'"><td class="submissions"><a class="lite" href="container.php?action=submissions&context=review&submission='.$row['submission_id'].'">'.$row['title'].'</a></td>';
        echo '<td class="submissions">'.$row['first_name'].' '.$row['last_name'].'</td>';
        
        echo '</tr>'."\n";
      }
        
       
      echo '</table>';
    }
    else{
      echo '<p>There are no submissions for this show.</p>';
    }
  }
}   

elseif($context == "review"){

    $sql = 'SELECT * FROM Submissions
            WHERE submission_id = "'.$_GET['submission'].'"';
                
    if($result = mysqli_query($connection_string, $sql)){
    
      while($row = mysqli_fetch_array($result)){
      
        echo '<h1>'.$row['title']."</h1>\n";
        echo '<p><span class="label">Medium:</span> '.$row['medium']."</p>\n";
        echo '<p><span class="label">Tone:</span> '.$row['tone']."</p>\n";
        echo '<p><span class="label">Length:</span> '.$row['length']."</p>\n";

        if($row['links'] != ''){
         echo '<p><span class="label">Link:</span> <a class="lite" href="'.$row['links'].'">'.$row['links']."</a></p>\n";
        }
        else{
        }
       
       echo '<p><span class="label">Synopsis:</span> '.nl2br($row['synopsis'])."</p>\n";

        echo '<h2 class="left">'.$row['first_name'].' '.$row['last_name']."</h2>\n";        
        echo '<p><span class="label">Email:</span> <a class="lite" href="mailto:'.$row['email'].'">'.$row['email']."</a></p>\n";
        
        if($row['stage_name'] != ''){
          echo '<p><span class="label">Stage Name:</span> '.$row['stage_name']."</p>\n";
        }
        $data = $row['phone'];
        echo '<p><span class="label">Phone:</span> '."(".substr($data, 0, 3).") ".substr($data, 3, 3)."-".substr($data,6);
        
        
        // COMMENTING OUT THE SUMBIT BUTTONS
        
        // echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">';
        // echo '<p><input type="submit" value="Reject"> <input type="submit" value="Edit"> <input type="submit" value="Approve">';
      
      }

    
    }

}

?>