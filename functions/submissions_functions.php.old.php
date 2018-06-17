<?php

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



// Primary Form //

function SubmissionForm($show_id){
  echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">';
  echo '<h2>Contact Information</h2>';
  echo '<label for="first_name">Name</label><input type="text" id="name" name="submission[first_name]" placeholder="First"> <input type="text" name="submission[last_name]" placeholder="Last"><br />';
  echo '<label for="stage_name">Stage Name</label><input type="text" id="stage_name" name="submission[stage_name]" placeholder="optional"><br />';
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
  
  
  //DEFINE MAIL VARIABLES
  $to      = 'grafixgeek@yahoo.com';
  $subject = 'Hello from Pull Up a Chair';
  $headers = 'From: admin@pullupachair.com' . "\r\n" .
             'Reply-To: admin@pullupachair.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion().
             'MIME-Version: 1.0'."\r\n".
             'Content-Type: text/html; charset=ISO-8859-1'."\r\n";
    
    
    
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
  
  //SEND EMAIL
  mail($to, $subject, $body, $headers);
}

?>