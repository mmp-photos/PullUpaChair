<?php

// Includes
include_once("connection_string.php");  
include_once("puac_functions.php");  

//Define variables from Post

if(isset($_POST['submit'])){
  $org_id = $_POST['org_id'];
  $year   = $_POST['year'];
  $file_type = $_FILES['test']['type'];
}

$target_path = "../images/db/".$filename;

if(move_uploaded_file($_FILES['test']['tmp_name'],$target_path)){

  $it_worked = "The file has been uploaded.";

}

else{

  $it_worked = "There was an error uploading the file, please try again!";

}





    $name_select = "SELECT org_name from edwatch WHERE org_id = '$org_id'";
  
    $name_results = mysql_query($name_select);

    while($name_row = mysql_fetch_array($name_results)){
    
      $name_result = $name_row['org_name'];
      
    }    
    
    
    $select = "SELECT * from edwatch_docs WHERE doc_org_id = '$org_id' AND doc_status = 'OK'";
  
    $results = mysql_query($select);

    while($result_row = mysql_fetch_array($results)){
    
      $existing_list =  $existing_list.$name_result.' <span class="z_bold">'.$result_row['doc_year'].'</span> 990 ---> <a target="_blank" href="http://www.greatschoolsforamerica.org/images/fin_docs/'.$result_row['doc_filename'].'.'.$result_row['doc_type'].'">view</a>, <a href="add_990.php?d=y&doc_id='.$result_row['doc_id'].'&org_id='.$result_row['doc_org_id'].'">delete</a><br />'."\n";
      
    }  
      
    $result = '<h2>'.$name_result.'</h2>'."\n <p>".$it_worked.'</p>'.$existing_list.'<p>&nbsp;</p>'."\n".'<h3>Insert More 990 Tax Forms</h3>';

  }

}

?>