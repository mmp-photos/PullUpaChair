<?php

// GET ALL SHOWS

  function GetAllShows($connection_string){
    $connection_string = $connection_string;

    $sql = 'SELECT * FROM ShowInfo
            LEFT JOIN `Venue` ON Venue.VenueID = ShowInfo.ShowLocation 
            WHERE ShowStatus = "ACTV"
            ORDER BY ShowDateTime DESC';
    
    if($result2 = mysqli_query($connection_string, $sql)){
      return $result2;
    }else{
      die('Error: ' . mysqli_error($connection_string));
    }
  }
  
       
// DEFINE SHOW OBJECT

  class Show {
    
    var $show_id;
    var $show_title;
    var $show_date;
    var $description;
    var $status;
    
    var $ticket_link;
    var $ticket_sale;

    var $submission_start;
    var $submission_end;
    
    var $venue_name;
    var $venue_address;
    var $venue_city;
    var $venue_state;
    var $venue_zip;
    var $venue_web;
    var $venue_phone;
    
    var $access;
    
    public function set_name($row){
      $this->show_id          = $row['ShowID'];
      $this->show_title       = $row['ShowName'];
      $this->show_date        = $row['ShowDateTime'];
      $this->description      = $row['ShowDescription'];
      $this->status           = $row['ShowStatus'];
      $this->current_date     = date('Y-m-d h:i:s');
      $this->current_date2    = date('Y-m-d h:i:s');
      $this->ticket_link      = $row['TicketLink'];
      $this->ticket_sale      = $row['TicketSale'];
      $this->submission_start = $row['SubmissionOpen'];
      $this->submission_end   = $row['SubmissionClose'];
      $this->venue_name       = $row['VenueName'];
      $this->venue_address    = $row['VenueAddress'];
      $this->venue_city       = $row['VenueCity'];
      $this->venue_state      = $row['VenueState'];
      $this->venue_zip        = $row['VenueZip'];
      $this->venue_web        = $row['VenueWebsite'];
      $this->venue_phone      = '('.substr($row['VenuePhoneNumber'], 0, 3).') '.substr($row['VenuePhoneNumber'], 3, 3).'-'.substr($row['VenuePhoneNumber'],6);

    }
    
    public function get_name(){
      echo $this->show_title.'<br />';
      echo $this->show_date.'<br />';
      echo $this->description.'<br />';
      echo $this->status.'<br />';
      echo $this->ticket_link.'<br />';
      echo $this->ticket_sale.'<br />';
      echo $this->submission_start.'<br />';
      echo $this->submission_end.'<br />';
      echo $this->venue_name.'<br />';
      echo $this->venue_address.'<br />';
      echo $this->venue_city.'<br />';
      echo $this->venue_state.'<br />';
      echo $this->venue_zip.'<br />';
      echo $this->venue_web.'<br />';
      echo $this->venue_phone.'<br />';
    }

//SELECT THE NEXT UPCOMING SHOW
  public function ShowObject($connection_string){

    $current_date = date('Y-m-d h:i:s');
    $connection_string2 = $connection_string;

    $sql = 'SELECT * FROM ShowInfo
            LEFT JOIN `Venue` ON Venue.VenueID = ShowInfo.ShowLocation 
            WHERE ShowDateTime > CURRENT_TIMESTAMP AND ShowStatus = "ACTV"';
    
    if($result2 = mysqli_query($connection_string, $sql)){

      while($row = mysqli_fetch_array($result2)){
        return $row;
      }
    }else{
     
      die('Error: ' . mysqli_error($connection_string));
    }
  }
    
  public function TicketLink($current_date){
    if($current_date >= $this->ticket_sale && $current_date <= $this->show_date){
      echo '<p class="tickets"><a class="submission" href="'.$this->ticket_link.'">Tickets</a></p>';
    }
  }
  
  public function TicketLinkNav($current_date){
    if($current_date >= $this->ticket_sale && $current_date <= $this->show_date){
      echo '<li><a class="nav" href="'.$this->ticket_link.'">Tickets</a></li>';
    }
  }
  public function SubmissionLinkNav($current_date){
    if($current_date >= $this->submission_start && $current_date <= $this->submission_end){
      echo '<li><a class="nav" href="submissions.php">Submit a Story</a></li>';
    }
  }
  public function NextShow($show_id){
    if($this-> show_date >= $this-> current_date){
      
        $date            = strtotime($this->show_date);
        $formatted_month = date("F", $date);
        $formatted_day   = date("d", $date);
      
      echo '<div id="show_box_index">';
      echo '<div id="upcoming_index">';
   	   echo '<p class="next_show">Next Show</p>';
      echo '<p class="calendar_day">'.$formatted_day.'</p>';
      echo '<p class="calendar_month">'.$formatted_month.'</p></div>';
      if($this->current_date >= $this->submission_start && $this->current_date <= $this->submission_end){
        echo '<p><a class="submission" href="submissions.php">Submissions Open</a></p>';
      }
      if($this->current_date >= $this->ticket_sale && $this->current_date <= $this->show_date){
        echo '<p class="tickets"><a class="submission" href="'.$this->ticket_link.'">Tickets</a></p>';
      }
      echo '</div>';
    }
  }
  
  function ShowID($connection_string){
  
    $current_date = date('Y-m-d h:i:s');
    $connection_string2 = $connection_string;

    $sql = 'SELECT * FROM ShowInfo
            LEFT JOIN `Venue` ON Venue.VenueID = ShowInfo.ShowLocation 
            WHERE ShowDateTime > CURRENT_TIMESTAMP AND ShowStatus = "ACTV" LIMIT 1';
    
    if($result2 = mysqli_query($connection_string2, $sql)){

      while($row = mysqli_fetch_array($result2)){
        $this->show_id =$row['ShowID'];
        return $this->show_id;
      }
    }
  }
  
  public function ListShows(){
    if($this->show_title != ""){
      $show_name = $this->show_title;
    }else{
      $show_name = "Untitled";
    }
    if($this->venue_web != ""){
      $venue_name = '<a href="'.$this->venue_web.'">'.$this-> venue_name.'</a>';
    }else{
      $venue_name = $this-> venue_name;
    }
    $show_date = date('F j, Y', strtotime($this-> show_date));
    echo '<h2 class="show_name">'.$show_name.'</h2>';
    echo '<p class="margin_bottom">'.$show_date.'</p>'."\n";
    echo '<p>'.$venue_name.'<br />'."\n";
    echo $this->venue_address.'<br />'."\n";
    echo $this->venue_city.' '.$this->venue_state.' '.$this->venue_zip.'<br /></p>'."\n";
    
    $description = stripslashes($this->description);
    echo '<p>'.$description.'</p>'; 

  }
}

?>