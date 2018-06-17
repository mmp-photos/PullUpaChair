<?php

 function SelectSubmissionPerformer($connection_string, $UserID, $show_id){
    $sql = 'SELECT * FROM `Submissions` 
            WHERE `UserID` = '.$UserID.'
            AND show_id = '.$show_id;
    
    if($result = mysqli_query($connection_string, $sql)){
      return $result;
    }
    else{
      die('Error: ' . mysqli_error($connection_string));
    }
  }
// DEFINE USER OBJECT

  class Submission {
    
    var $submission_id;
    var $user_id;
    var $first_name;
    var $last_name;
    var $stage_name;
    var $email;
    var $phone;
    var $title;
    var $length;
    var $medium;
    var $tone;
    var $synopsis;
    var $introduction;
    var $submission_photo;
    var $links;
    var $show_id;
    var $date_submitted;
    var $date_reviewed;
    var $reviewed_by;
    var $status;
    var $terms;
    
    public function set_name($row){
      if(ISSET($row['submission_id'])){    $this->submission_id    = $row['submission_id']; }
      if(ISSET($row['user_id'])){          $this->UserID           = $row['show_id']; }
      if(ISSET($row['first_name'])){       $this->first_name       = $row['first_name']; }
      if(ISSET($row['last_name'])){        $this->last_name        = $row['last_name']; }
      if(ISSET($row['stage_name'])){       $this->stage_name       = $row['stage_name']; }
      if(ISSET($row['email'])){            $this->email            = $row['email']; }
      if(ISSET($row['phone'])){            $this->phone            = $row['phone']; }
      if(ISSET($row['title'])){            $this->title            = $row['title']; }
      if(ISSET($row['length'])){           $this->length           = $row['length']; }
      if(ISSET($row['medium'])){           $this->medium           = $row['tone']; }
      if(ISSET($row['tone'])){             $this->tone             = $row['tone']; }
      if(ISSET($row['synopsis'])){         $this->synopsis         = $row['synopsis']; }
      if(ISSET($row['introduction'])){     $this->introduction     = $row['introduction']; }
      if(ISSET($row['submission_photo'])){ $this->submission_photo = $row['submission_photo']; }      
      if(ISSET($row['links'])){            $this->links            = $row['links']; }
      if(ISSET($row['show_id'])){          $this->show_id          = $row['show_id']; }
      if(ISSET($row['date_submitted'])){   $this->date_submitted   = $row['date_submitted']; }
      if(ISSET($row['date_reviewed'])){    $this->date_reviewed    = $row['date_reviewed']; }
      if(ISSET($row['reviewed_by'])){      $this->reviewed_by      = $row['reviewed_by']; }
      if(ISSET($row['status'])){           $this->status           = $row['status']; }
      if(ISSET($row['terms'])){            $this->terms            = $row['terms']; }
    }

//SELECT A SUBMISSION BY SUBMISSION_ID
  public function FetchSubmission($connection_string, $submission_id){
    $sql = 'SELECT * FROM `Submissions` WHERE `submission_id` = '.$submission_id;
    if($result = mysqli_query($connection_string, $sql)){
      while($row = mysqli_fetch_array($result)){
        return $row;
      }
    } else {
      die('Error: ' . mysqli_error($connection_string));
    }   

  }

//SELECT A SUBMISSION BY PERFORMER AND SHOW
  public function FetchSubmissionPerformer($connection_string, $submission_id){
    $sql = 'SELECT * FROM `Submissions` WHERE `submission_id` = '.$submission_id;
    if($result = mysqli_query($connection_string, $sql)){
      while($row = mysqli_fetch_array($result)){
        return $row;
      }
    } else {
      die('Error: ' . mysqli_error($connection_string));
    }   

  }
//OUTPUT THE DETAILS OF THE SUBMISSION
    public function SubmissionDisplay(){

      if($this->status == "DLTD"){
        echo "The submission has been deleted.";
      }
      else{
        if($this->title != ''){
          echo '<h1>'.$this->title.'</h1>';
        }
        else{
          echo '<h1>Untitled</h1>';
        }

        echo '<h2 class="left">'.$this->first_name.' '.$this->last_name."</h2>\n";        

        if($this->length != ''){
          echo '<p><span class="label">Length:</span>'.$this->length."</p>\n";
        }

        if($this->links != ''){
          echo '<p><span class="label">Link:</span> <a class="lite" href="'.$this->links.'">LINK'."</a></p>\n";
        }
        else{
        }
       
        echo '<p><span class="label">Synopsis:</span> '.nl2br($this->synopsis)."</p>\n";

        echo '<p><span class="label">Email:</span> <a class="lite" href="mailto:'.$this->email.'">'.$this->email."</a></p>\n";
        
        if($this->stage_name != ''){
          echo '<p><span class="label">Stage Name:</span> '.$this->stage_name."</p>\n";
        }
      }
    }



    //FORM FOR NEW SUBMISSIONS
    public function SubmissionForm($show_id){
      echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">';
      echo '<h2>Contact Information</h2>';
      echo '<label for="first_name">Name</label><input type="text" id="name" name="submission[first_name]" placeholder="First"> <input type="text" name="submission[last_name]" placeholder="Last"><br />';
      echo '<label for="stage_name">Stage Name</label><input type="text" id="stage_name" name="submission[stage_name]" placeholder="optional"><br />';
      echo '<label for="email">Email</label><input type="text" id="email" name="submission[email]" placeholder=""><br />';
      echo '<label for="phone">Phone</label><input type="text" id="phone" name="submission[phone]" /><br />';

      echo '<h2>Story Information</h2>';
      echo '<label for="title">Title</label><input type="text" id="title" name="submission[title]" /><br />';
      echo '<label for="performance">Performance Medium</label><input type="text" id="performance" name="submission[medium]" /><br />';
      echo '<label for="tone">Tone</label><input type="text" id="tone" name="submission[tone]" /><br />';
      echo '<label for="length">Length</label><input type="text" id="length" name="submission[length]" placeholder="Approximate in Minutes"/><br />';
      echo '<label for="links">Link</label><input type="text" id="links" name="submission[links]" placeholder="Optional"/><br />';
      echo '<label for="synopsis">Synopsis</label><textarea id="synopsis name="submission[synopsis]" rows="12" cols="40"></textarea><br />';
      echo '<label class="normal" for="terms">Terms & Conditions</label><input type="checkbox" id="fine_print" name="submission[terms]" /><span class="fine_print"> I accept the <a href="terms.php" target="_blank">Terms and Conditions</a></span><br />';
      echo '<input type="hidden" name="posted" value="TRUE">';
      echo '<input type="hidden" name="show_id" value="'.$show_id.'"/><br />';
      echo '<label></label><input type="submit" class="formbutton" name="submit" value="Submit">';
      echo '</form>';
    }

//INSERT SUBMISSION INTO DATABASE
  function InsertSubmission($connection_string){

    $phone          = preg_replace("/[^0-9]/", "", $this->phone);
    $date_submitted = date("Y-m-d h:m:s");
    $date_reviewed  = date("Y-m-d h:m:s");
    $reviewed_by    = '000';
    $status         = 'SB';
    $terms          = $submission['terms'];

    $sql = sprintf("INSERT INTO Submissions (first_name,last_name,stage_name,email,phone,title,medium,tone,length,synopsis,links,show_id,date_submitted,date_reviewed,reviewed_by,status,terms) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", 
    
      mysqli_real_escape_string($connection_string,$this->first_name), 
      mysqli_real_escape_string($connection_string,$this->last_name), 
      mysqli_real_escape_string($connection_string,$this->stage_name),
      mysqli_real_escape_string($connection_string,$this->email),
      mysqli_real_escape_string($connection_string,$this->phone),
      mysqli_real_escape_string($connection_string,$this->title),
      mysqli_real_escape_string($connection_string,$this->medium),
      mysqli_real_escape_string($connection_string,$this->tone),
      mysqli_real_escape_string($connection_string,$this->length),
      mysqli_real_escape_string($connection_string,$this->synopsis),
      mysqli_real_escape_string($connection_string,$this->links),
      mysqli_real_escape_string($connection_string,$this->show_id),
      mysqli_real_escape_string($connection_string,$this->date_submitted),
      mysqli_real_escape_string($connection_string,$this->date_reviewed),
      mysqli_real_escape_string($connection_string,$this->reviewed_by),
      mysqli_real_escape_string($connection_string,$this->status),
      mysqli_real_escape_string($connection_string,$this->terms));
      
      echo $sql;
      die;
    
    if($result = mysqli_query($connection_string, $sql)){
         $state = 'confirm';    
        } else {
      die('Error: ' . mysqli_error($connection_string));
    }   
//  return $state;
}




// APPROVE SUBMISSON OF STORY

    public function ApproveSubmission(){
      $current_date = date('Y-m-d h:i:s');
      $connection_string = $connection_string;

// NEED TO WRITE UPDATE SQL      $sql = 'SELECT ShowID
//              FROM ShowInfo
//              WHERE ShowDateTime > CURRENT_TIMESTAMP
//              LIMIT 1';
    
      if($result = mysqli_query($connection_string, $sql)){
             
        while($row = mysqli_fetch_array($result)){
          $show_id        = $row['ShowID'];
          
          echo 'The story '.$this->title.' has been approved.';
          $this->SubmissionDisplay();          
        }
  
      }else{
    
       die('Error: ' . mysqli_error($connection_string));
      }
    }

//SEND EMAIL TO NIKKI

  public function SendSubmissionEmail(){
    
    $to      = 'indypullupachair@gmail.com';
    $subject = 'New Submission';
    $headers = 'From: admin@pullupachair.com' . "\r\n" .
               'Reply-To: admin@pullupachair.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion().
               'MIME-Version: 1.0'."\r\n".
               'Content-Type: text/html; charset=ISO-8859-1'."\r\n";


  //SET CONTENT OF EMAIL MESSAGE    

  if($this->stage_name != ''){
    $body = '<p>Name: '.$this->stage_name."</p>\n";
  }
  else{
    $body = '<p>Name: '.$this->first_name."</p>\n";    
  }

  $body = $body.'<p>Email: '.$this->email."<br />\n";
  $body = $body.'Phone: '.$this->phone."<br />\n";
  $body = $body.'<hr />';
  $body = $body.'Title: '.$this->title."<br />\n";
  $body = $body.'Medium: '.$this->medium."<br />\n";
  $body = $body.'Tone: '.$this->tone."<br />\n";
  $body = $body.'Length: '.$this->length."</p>\n";

       if($this->links != ''){
  $body = $body.'<p>'.$this->links."</p>\n";
        }
        
  $body = $body.'<p>Synopsis: '.$this->synopsis."</p>\n";
    
  //SEND EMAIL
    mail($to, $subject, $body, $headers);
}

  public function ArtistEditSubmission($connection_string, $user, $show_id){
    $connection_string = $connection_string;
    $UserID = $user;
    $show_id = $show_id;
    $result = SelectSubmissionPerformer($connection_string, $UserID, $show_id);
    while($row = mysqli_fetch_array($result)){
      $this->SubmissionDisplay();      
    }
  }
}
?>