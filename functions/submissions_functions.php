<?php

// SELECT UPCOMING SHOW //

function GetShowID($current_date, $connection_string){
    
    $current_date = date('Y-m-d h:i:s');
    $connection_string2 = $connection_string;

    $sql = 'SELECT ShowID
            FROM ShowInfo
            WHERE ShowDateTime > CURRENT_TIMESTAMP
            LIMIT 1';
    
    if($result = mysqli_query($connection_string2, $sql)){
             
      while($row = mysqli_fetch_array($result)){
        $show_id        = $row['ShowID'];
      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }
    
    return $show_id;

}

// SHOW TERMS AND CONDITIONS
function ShowTerms($current_date, $connection_string){
    
    $current_date = date('Y-m-d h:i:s');
    $connection_string2 = $connection_string;

    $sql = 'SELECT *
            FROM Terms
            WHERE status = "CRNT"
            LIMIT 1';
    
    if($result = mysqli_query($connection_string2, $sql)){
             
      while($row = mysqli_fetch_array($result)){
        echo $row['terms_text'];
      }
  
    }else{
    
       die('Error: ' . mysqli_error($connection_string));
    }
    
}

// SELECT UPCOMING SHOW //

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

// Primary Form //

function SubmissionForm($show_id){
  echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">';
  echo '<h2>Contact Information</h2>';
  echo '<label for="first_name">Name</label><input type="text" name="first_name" placeholder="First"> <input type="text" name="last_name" placeholder="Last"><br />';
  echo '<label for="stage_name">Stage Name</label><input type="text" name="stage_name" placeholder="optional"><br />';
  echo '<label for="email">Email</label><input type="text" name="email" placeholder=""><br />';
  echo '<label for="phone">Phone</label><input type="text" name="phone" /><br />';

  echo '<h2>Story Information</h2>';
  echo '<label for="title">Title</label><input type="text" name="title" /><br />';
  echo '<label for="performance">Performance Medium</label><input type="text" name="medium" /><br />';
  echo '<label for="tone">Tone</label><input type="text" name="tone" /><br />';
  echo '<label for="length">Length</label><input type="text" name="length" placeholder="Approximate in Minutes"/><br />';
  echo '<label for="links">Link</label><input type="text" name="links" placeholder="Optional"/><br />';
  echo '<label for="synopsis">Synopsis</label><textarea name="synopsis" rows="12" cols="40"></textarea><br />';
  echo '<label class="normal" for="terms">Terms & Conditions</label><input type="checkbox" name="terms" /><span class="fine_print"> I accept the <a href="terms.php" target="_blank">Terms and Conditions</a></span><br />';
  echo '<input type="hidden" name="posted" value="TRUE">';
  echo '<input type="hidden" name="show_id" value="'.$show_id.'"/><br />';
  echo '<label></label><input type="submit" class="formbutton" name="submit" value="Submit">';
  echo '</form>';
}

// Error Checking //

function submission($posted){
  $submission = $posted;
  if($submission['first_name'] == ""){
    $error['first_name'] = "error";
    $error['edit'] = "edit";
  }
  else {
    $error['first_name'] = "normal";
  }
  
  if($submission['last_name'] == ""){
    $error['last_name'] = "error";
    $error['edit'] = "edit";
  }
  else {
    $error['last_name'] = "normal";
  }

  if($submission['email'] == ""){
    $error['email'] = "error";
    $error['edit'] = "edit";
  }  
  else {
    $error['email'] = "normal";
  }

  if($submission['phone'] == ""){
    $error['phone'] = "error";
    $error['edit'] = "edit";
  }
  else {
    $error['phone'] = "normal";
  }

  if($submission['title'] == ""){
    $error['title'] = "error";
    $error['edit'] = "edit";
  }
  else {
    $error['title'] = "normal";
  }
  
  if($submission['medium'] == ""){
    $error['medium'] = "error";
    $error['edit'] = "edit";
  }  
  else {
    $error['medium'] = "normal";
  }

  if($submission['tone'] == ""){
    $error['tone'] = "error";
    $error['edit'] = "edit";
  }
  else {
    $error['tone'] = "normal";
  }

  if($submission['length'] == ""){
    $error['length'] = "error";
    $error['edit'] = "edit";
  }
  else {
    $error['length'] = "normal";
  }

  if($submission['synopsis'] == ""){
    $error['synopsis'] = "error";
    $error['edit'] = "edit";
  }
  else {
    $error['synopsis'] = "normal";
  }
  if(!ISSET($submission['terms'])){
    $error['terms'] = "error";
    $error['edit'] = "edit";
  }
  else {
    $error['terms'] = "normal";
  }  
  return($error);

}

function InsertSubmission($error, $posted, $connection_string, $show_id){
  if(ISSET($_POST["posted"])){

    $error             = $error;
    $submission        = $posted;
    $connection_string = $connection_string;
      
    $first_name     = $submission['first_name'];
    $last_name      = $submission['last_name'];
    $stage_name     = $submission['stage_name'];
    $email          = $submission['email'];
    $phone          = preg_replace("/[^0-9]/", "", $submission['phone']);
    $medium         = $submission['medium'];
    $title          = $submission['title'];
    $tone           = $submission['tone'];
    $length         = $submission['length'];
    $synopsis       = $submission['synopsis'];
    $links          = $submission['links'];
    $show_id        = $submission['show_id'];
    $terms          = $submission['show_id'];
    $date_submitted = date("Y-m-d h:m:s");
    $date_reviewed  = date("Y-m-d h:m:s");
    $reviewed_by    = '000';
    $status         = 'SB';
    $terms          = $submission['terms'];

    $sql = sprintf("INSERT INTO Submissions (first_name,last_name,stage_name,email,phone,title,medium,tone,length,synopsis,links,show_id,date_submitted,date_reviewed,reviewed_by,status,terms) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", 
    
      mysqli_real_escape_string($connection_string,$first_name), 
      mysqli_real_escape_string($connection_string,$last_name), 
      mysqli_real_escape_string($connection_string,$stage_name),
      mysqli_real_escape_string($connection_string,$email),
      mysqli_real_escape_string($connection_string,$phone),
      mysqli_real_escape_string($connection_string,$title),
      mysqli_real_escape_string($connection_string,$medium),
      mysqli_real_escape_string($connection_string,$tone),
      mysqli_real_escape_string($connection_string,$length),
      mysqli_real_escape_string($connection_string,$synopsis),
      mysqli_real_escape_string($connection_string,$links),
      mysqli_real_escape_string($connection_string,$show_id),
      mysqli_real_escape_string($connection_string,$date_submitted),
      mysqli_real_escape_string($connection_string,$date_reviewed),
      mysqli_real_escape_string($connection_string,$reviewed_by),
      mysqli_real_escape_string($connection_string,$status),
      mysqli_real_escape_string($connection_string,$terms));
    
    if($result = mysqli_query($connection_string, $sql)){
         $state = 'confirm';    
        } else {
      die('Error: ' . mysqli_error($connection_string));
    }   
  }
  return $state;
}

function SubmissionErrors($error, $posted, $show_id){

  $show_id    = $show_id;
  $error      = $error;
  $submission = $posted;
  
  echo '<h2>Contact Information</h2>';
  echo '<p>Please correct the items marked in red.</p>';
  echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">';
  echo '<label class="'.$error['first_name'].'" for="first_name">Name</label><input type="text" name="first_name" placeholder="First" value="'.$submission['first_name'].'">';
  echo '<input class="'.$error['last_name'].'" type="text" name="last_name" placeholder="Last" value="'.$submission['last_name'].'"><br />';
  echo '<label class="normal" for="stage_name">Stage Name</label><input type="text" name="stage_name" placeholder="optional" value="'.$submission['stage_name'].'"><br />';
  echo '<label class="'.$error['email'].'" for="email">Email</label><input type="text" name="email" placeholder="" value="'.$submission['email'].'"><br />';
  echo '<label class="'.$error['phone'].'" for="phone">Phone</label><input type="text" id="phone" name="phone" value="'.$submission['phone'].'"/><br />';

  echo '<h2>Story Information</h2>';
  echo '<label class="'.$error['title'].'" for="title">Title</label><input type="text" name="title" value="'.$submission['title'].'" /><br />';
  echo '<label class="'.$error['medium'].'" for="performance">Performance Medium</label><input type="text" name="medium" value="'.$submission['medium'].'"/><br />';
  echo '<label class="'.$error['tone'].'" for="tone">Tone</label><input type="text" name="tone" value="'.$submission['tone'].'" /><br />';
  echo '<label class="'.$error['length'].'" for="length">Length</label><input type="text" name="length" placeholder="Approximate in Minutes" value="'.$submission['length'].'" /><br />';
  echo '<label class="normal" for="links">Link</label><input type="text" name="links" placeholder="Optional" value="'.$submission['links'].'" /><br />';
  echo '<label class="'.$error['synopsis'].'" for="synopsis">Synopsis</label><textarea name="synopsis" rows="12" cols="40">'.$submission['synopsis'].'</textarea><br />';
  echo '<label class="normal" for="terms">Terms & Conditions</label><input type="checkbox" name="terms" /><span class="fine_print"> I accept the <a href="terms.php" target="_blank">Terms and Conditions</a></span><br />';

  echo '<input type="hidden" name="posted" value="TRUE">';
  echo '<input type="hidden" name="show_id" value="'.$show_id.'"/><br />';

  echo '<label></label><input type="submit" class="formbutton" name="submit" value="Submit">';
  echo '</form>';
}

// Verification Page //

function VerificationPage($error, $posted){

  $error      = $error;
  $submission = $posted;
  
  echo '<p>Thank you for submitting your story to Pull Up a Chair.  If your story is selected you will be contacted for further details.</p>'."\n";

  echo '<p>'.$submission['first_name'].' '.$submission['last_name']."</p>\n";

       if($submission['stage_name'] != ''){
  echo   '<p>'.$submission['stage_name']."</p>\n";
        }
        
  echo '<p>Name: '.$submission['email']."</p>\n";
  
       if($submission['stage_name'] != ''){
  echo '<p>Stage Name: '.$submission['stage_name']."</p>\n";
       }
  
  echo '<p>Email: '.$submission['email']."</p>\n";
  echo '<p>Phone: '.$submission['phone']."</p>\n";
  echo '<hr />';
  echo '<p>Title: '.$submission['title']."</p>\n";
  echo '<p>Medium: '.$submission['medium']."</p>\n";
  echo '<p>Tone: '.$submission['tone']."</p>\n";
  echo '<p>Length: '.$submission['length']."</p>\n";

       if($submission['links'] != ''){
  echo '<p>'.$submission['links']."</p>\n";
        }
        
  echo '<p>Synopsis: '.$submission['synopsis']."</p>\n";
}


function MailSubmission($error, $posted){

  $error      = $error;
  $submission = $posted;
  
  $body = '<p>Name: '.$submission['email']."</p>\n";

       if($submission['stage_name'] != ''){
  $body = $body.'<p>Stage Name: '.$submission['stage_name']."</p>\n";
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
  
  //send email
  mail($admin_email, "$subject", $body, "From:" . $email);
}

?>