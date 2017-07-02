<?php

function GetShowID($current_date, $connection_string){
    
    $current_date = date('Y-m-d h:i:s');
    $connection_string = $connection_string;

    $sql = 'SELECT ShowID
            FROM ShowInfo
            WHERE ShowDateTime > CURRENT_TIMESTAMP
            LIMIT 1';
    
    if($result = mysqli_query($connection_string, $sql)){
             
      while($row = mysqli_fetch_array($result)){
        $show_id        = $row['ShowID'];
      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }
    
    return $show_id;

}

function GetSubmissions($show_id){

  
  
}
?>