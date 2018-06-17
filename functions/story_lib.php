<?php

//SELECT A STORY FROM THE DATABASE
  function SelectStory($connection_string){
    
    $connection_string = $connection_string;

    $sql = 'SELECT * FROM 
           `Stories` 
            LEFT JOIN `Performers` on Stories.Performer = Performers.PerformerID
            LEFT JOIN `ShowInfo` on Stories.ShowID = ShowInfo.ShowID
            ORDER BY RAND()
            LIMIT 1';
    
    if($result = mysqli_query($connection_string, $sql)){
      while($row = mysqli_fetch_array($result)){
        return($row);
      }
    }
  }

  function SelectStoryByPerformer($performer, $connection_string){
    
    $connection_string = $connection_string;

    $sql = 'SELECT * FROM 
           `Stories` 
            LEFT JOIN `Performers` on Stories.Performer = Performers.PerformerID
            LEFT JOIN `ShowInfo` on Stories.ShowID = ShowInfo.ShowID
            WHERE `PerformerID` = "'.$performer.'"';
    
    if($result = mysqli_query($connection_string, $sql)){
      return($result);
    }
  }
  
// DEFINE STORY OBJECT
  class Story {
    
    var $prefix;
    var $story_id;
    var $story_name;
    var $show_order;
    var $story_description;
    var $story_status;
    var $date_added;
    var $date_updated;
    var $video_embed;
    var $featured;
    var $photo;
    
    var $performer_id;
    var $performer_first_name;
    var $performer_last_name;
    var $performer_bio;
    var $performer_photo;

    var $show_id;
    var $show_name;
    var $show_date;
    var $show_description;
    var $show_status;

//SET OBJECT PROPERTIES        
    public function set_name($row){
      $this->prefix            = $row['Prefix'];
      $this->story_id          = $row['StoryID'];
      $this->story_name        = $row['StoryName'];
      $this->show_order        = $row['ShowID'];
      $this->story_description = $row['StoryDescription'];
      $this->story_status      = date('StoryStatus');
      $this->date_added        = date('SDateAdded');
      $this->date_updated      = $row['SDateUpdated'];
      $this->video_embed       = $row['VideoEmbed'];
      $this->featured          = $row['Featured'];
      $this->photo             = $row['Photo'];

      $this->performer_id         = $row['PerformerID'];
      $this->performer_first_name = $row['PerformerFirstName'];
      $this->performer_last_name  = $row['PerformerLastName'];
      $this->performer_bio        = $row['PerformerBio'];
      $this->performer_photo      = $row['PerformerPhoto'];

//      $this->show_id          = $row['VenueName'];
//      $this->show_name        = $row['VenueAddress'];
//      $this->show_date        = $row['VenueCity'];
//      $this->show_description = $row['VenueState'];
//      $this->show_status      = $row['VenueZip'];
  }

// OUTPUT SELECTED STORY
  public function ShowStory(){
    if(ISSET($this->story_name)){
      echo '<h2 class="story-title">'.$this->story_name.'</h2>'."\n";
//      echo '<p class="show-date">Show: '.date("M d, Y", $this->show_date).'</p>';
      echo $this->video_embed."\n";
      echo '<p class="story-description">'.$this->story_description.'</p>'."\n";
    }
    else{
      echo '<p class="story-description">The story could not be found.</p>'."\n";
    }
  }
}
?>