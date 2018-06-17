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

function SendSubmissionEmail(){
  $error      = $error;
  $submission = $posted;
  
  
  //DEFINE MAIL VARIABLES
  $to      = 'grafixgeek@yahoo.com';
  $subject = 'Hello from Pull Up a Chair';
  $headers = 'From: admin@pullupachair.com' . "\r\n" .
             'Reply-To: admin@pullupachair.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion().
             'MIME-Version: 1.0'."\r\n".
             'Content-Type: text/html; charset=ISO-8859-1'."\r\n";
    
    
    

    if($this->stage_name != ''){
      $body = $body.'<p>Name: '.$this->stage_name."</p>\n";
    }
    else{
      $body = $body.'<p>Name: '.$this->first."</p>\n";    
    }

  $body = $body.'<p>Email: '.$submission['email']."</p>\n";
  $body = $body.'<p>Phone: '.$submission['phone']."</p>\n";
  $body = $body.'<hr />';
  $body = $body.'<p>Title: '.$submission['title']."</p>\n";
  $body = $body.'<p>Medium: '.$submission['medium']."</p>\n";
  $body = $body.'<p>Tone: '.$submission['tone']."</p>\n";
  $body = $body.'<p>Length: '.$submission['length']."</p>\n";

       if($submission['links'] != ''){
  $body = $body.'<p>'.$submission['links']."</p>\n";
        }
        
  $body = $body.'<p>Synopsis: '.$submission['synopsis']."</p>\n";
  
  $admin_email = "admin@pullupachairindy.com";
  $email = 'grafixgeek@yahoo.com';
  $subject = 'Submission for Show';
  
  //SEND EMAIL
  mail($to, $subject, $body, $headers);
}
?>