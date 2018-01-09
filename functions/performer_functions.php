<?php
// SELECT ALL PERFORMERS
  function GetAllPerformers($connection_string){
    $connection_string = $connection_string;
    $sql = 'SELECT * FROM `Performers`
            ORDER BY `PerformerPhoto` DESC';
    if($result = mysqli_query($connection_string, $sql)){
      return $result;
    }
    else{    
      die('Error: ' . mysqli_error($connection_string));
    }
  }

//SELECT PERFORMER BY ID
  function GetPerformer($artist_id, $connection_string){
    $performer         = $artist_id;
    $connection_string = $connection_string;
    $sql = 'SELECT * FROM `Performers` WHERE `PerformerID` = "'.$performer.'"';
    if($result = mysqli_query($connection_string, $sql)){
      while($row = mysqli_fetch_array($result)){
        $artist['pfirst_name'] = stripslashes($row['PerformerFirstName']);
        $artist['plast_name']  = stripslashes($row['PerformerLastName']);
        $artist['bio']         = stripslashes($row['PerformerBio']);
      }
    }
    else{    
      die('Error: ' . mysqli_error($connection_string));
    }
    return $artist;
  }

//LINKS BY PERFORMER ID
  function PerformerLinks($artist_id, $connection_string){
    $performer         = $artist_id;
    $connection_string = $connection_string;
    
    $sql = 'SELECT * FROM `Links` WHERE `LinkPerformer` = "'.$performer.'"';
    if($result = mysqli_query($connection_string, $sql)){
      while($row = mysqli_fetch_array($result)){
        $link_info['LinkURL']    = stripslashes($row['LinkURL']);
        $link_info['LinkType']   = stripslashes($row['LinkType']);
        $link_info['LinkStatus'] = stripslashes($row['LinkStatus']);
        $performer_links[] = $link_info;
      }
    }
    else{    
    }
    if(ISSET($performer_links)){
      return $performer_links;
    }
  }
  
//DEFINE Performer OBJECT  
  class Performer {
    
    var $performer_id;
    var $first_name;
    var $last_name;
    var $bio;
    var $links;
    var $photo;
    
    public function set_name($row){
      $this->performer_id = stripslashes($row['PerformerID']);
      $this->first_name   = stripslashes($row['PerformerFirstName']);
      $this->last_name    = stripslashes($row['PerformerLastName']);
      $this->bio          = stripslashes($row['PerformerBio']);
      
      if($row['PerformerPhoto'] == ""){
        $this->photo = '<img class="performer_pic" src="images/DesignArt/GenericAvatar.png" alt="profile"/>';
      }
      else{
        $this->photo = '<img class="performer_pic" src="images/performers/'.$row['PerformerPhoto'].'" alt="profile"/>';
      }
    }
    public function PerformerPhoto(){
      echo $this->photo;
    }
    public function PerformerPage(){
      $performer_name = $this->first_name.' '.$this->last_name;
      echo '<h1 class="name">'.$performer_name.'</h1>';
      echo '<p>'.nl2br($this->bio).'</p>';
    }
    public function PerformerList(){
      echo '<div class="plist_name"><a href="performer.php?performer='.$this->performer_id.'">'.$this->photo.'</a><br />'."\n";
      $performer_name = $this->first_name.' '.$this->last_name;
      echo $performer_name.'</div>';
    }
    public function PerformerName(){
      $performer_name = $this->first_name.' '.$this->last_name;
      return $performer_name;
    }
  
  public function SetPerformerLink($links){
    $this->link = $links;
  }
  
  public function DisplayLinks($links){
    if($links != ""){
      foreach($links as $performer_link){
        if($performer_link['LinkStatus'] = 'AP'){
          switch($performer_link['LinkType']){
            case 'FB':
              echo '<a target="_blank" href="'.$performer_link['LinkURL'].'"><img class="links" alt="Facebook" src="images/DesignArt/social/Facebook.png" /></a>';
              break;
            case "TW":
              echo '<a target="_blank" href="'.$performer_link['LinkURL'].'"><img class="links" alt="Twitter" src="images/DesignArt/social/Twitter.png" /></a>';
              break;
            case "IN":
              echo '<a target="_blank" href="'.$performer_link['LinkURL'].'"><img class="links" alt="Instagram" src="images/DesignArt/social/Instagram.png" /></a>';
              break;
            case "ES":
              echo '<a target="_blank" href="'.$performer_link['LinkURL'].'"><img class="links" alt="Instagram" src="images/DesignArt/social/Etsy.png" /></a>';
              break;
            default:
              echo '<a target="_blank" href="'.$performer_link['LinkURL'].'"><img class="links" alt="Website" src="images/DesignArt/social/Web.png" /></a>';
            }
          }
        }
      }
    }
  }
?>