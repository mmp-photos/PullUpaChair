<?php
// Start the session
session_start();
if(ISSET($_SESSION['FirstName'])){
  $first_name = $_SESSION['FirstName'];
}
else{
 header('Location:index.php');
}

$page_title = 'Backstage: Control Center';

include_once("connection_string.php");  

include_once("puac_functions.php");  
include_once("functions/submissions_functions.php");  

if(ISSET($_POST['posted'])){

  $password = $_POST['password'];
  $email    = $_POST['email'];
  
  $sql = 'SELECT * FROM `UserAccess` WHERE `UserName` = "'.$email.'"';
    
  if($result = mysqli_query($connection_string, $sql)){
    
    while($row = mysqli_fetch_array($result)){
      
      $hash           = $row['UserPassword'];
      $first_name     = $row['UFirstName'];
      $UserAccess     = $row['UserAccess'];
      
      if (password_verify($password, $hash)) {

        $logged_in = TRUE;
        echo 'The passwords match';
      }   
    }
  }  
}
?>

<!DOCTYPE HTML>
<html>
<head>
  <?php
    include_once("include_header.php");  
  ?>
</head>

<body>

<div id="box">

<p><img src="images/menu.png" alt="navigation" id="mobile_nav" onclick="ShowDiv()"></p>

<div id="turn_off_nav" onclick="HideDiv()">

</div>

<div id="top_nav">
  <?php
    include 'navigation.php';
  ?>
    
</div>

<script>
  document.write(Logo);
</script>

<div id="main_nav">
  <?php
    include 'navigation.php';
  ?>
</div>

<div id="center-box">
<h1><?php echo 'Hello, '.$_SESSION['FirstName']; ?></h1>



<!-- NEWS SECTION -->

<div id="news-box">
<?php

  echo '<div id="news-box-left">';

  $show_id = GetShowID($current_date, $connection_string);

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

        echo '<tr class="'.$color.'"><td class="submissions-name">'.$row['first_name'].' '.$row['last_name'].'</td>';
        echo '<td class="submissions"><a class="lite" href="container.php?action=submissions&context=review&submission='.$row['submission_id'].'">'.$row['title'].'</a></td>';
        
        echo '</tr>'."\n";
      }
        
       
      echo '</table>';
    }
    else{
      echo '<p>There are no submissions for this show.</p>';
    }
  }
  
  /* COMMENTING OUT THIS SECTION
  
  echo '</div>';  
  echo '<div id="news-box-left">';
  echo '<h2>Add A News Update</h2>';
  echo '<form action="news_update.php" method="POST">';
  echo '<p class="label"><label for="update_title">Headline</label> <input id="update_title" type="text"></p>';
  echo '<p class="label"><label for="date_expires">Date Expires</label> <input type="text" id="datepicker" name="date_expires"></p>';
  echo '<p class="label"><label for="update_text">News Update Information</label> <textarea name="update_text" type="text" cols="24" rows="8"></textarea></p>';
  echo '<input name="status" type="hidden" value="AP"></p>';
  echo '<input name="posted" type="hidden" value="POSTED"></p>';
  echo '<input name="date_added" type="hidden" value="'.date('d/m/Y').'"></p>';
  echo '<p class="label"><label for="submit"></label> <input name="Submit" type="Submit">';
  echo '</form>';
  echo '</div>';
  
  echo '<div id="news-box-right">';
  echo '<h2>Update News Items</h2>';
  update_news($current_date, $connection_string);
  echo '</div>';
  
  */

?>
</div>

<!-- SHOW SECTION -->

<!--
<div id="show-box">
<h2> Add or Select a Show</h2>

</div>
-->

<!-- Add Story -->

<!-- COMMENTIONG OUT
<div id="story-box">
<?php
    
    echo '<h2>Add Story</h2>';
    echo '<form action="stories.php" method="POST">';
    echo '<p class="label"><label for="story_name">Title</label> <input name="story_name" type="text"></p>';

    // Select Shows For Dropdown Menu

    echo '<p class="label"><label for="show_date">Show Date</label> <select name="show_date">';
    echo '<option value="" SELECTED></option>';
    
    $sql = "SELECT * FROM `ShowInfo`";
    
    if($result = mysqli_query($connection_string, $sql)){
    
      while($row = mysqli_fetch_array($result)){
        $mkdate = strtotime($row['ShowDateTime']);
        echo '<option value="'.$row['ShowID'].'">'.date("M d, Y", $mkdate).'</option>\n';
      }
    }
    else{
      die('Error: ' . mysqli_error($connection_string));
    }
    
    echo '</select></p>';


    // Select Artists For Dropdown Menu

    echo '<p class="label"><label for="performer">Performer</label> <select name="performer">';
    
    $sql = "SELECT * FROM `Performers` WHERE `Status` = 'ACTV' ORDER BY `PerformerFirstName`";
    
    if($result = mysqli_query($connection_string, $sql)){
      while($row = mysqli_fetch_array($result)){
        if(!ISSET($first)){
          echo '<option value=""></option>\n';
          $first = TRUE;
        }
        echo '<option value="'.$row['PerformerID'].'">'.$row['PerformerFirstName'].' '.$row['PerformerLastName'].'</option>\n';
      }
    }
    else{
      $artists = die('Error: ' . mysqli_error($connection_string));
    }
    echo '</select></p>';
    
    echo '<p class="label"><label for="show_order">Show Order</label> <input name="show_order" type="text"></p>';
    echo '<p class="label"><label for="story_description">Story Description</label> <textarea name="story_description" type="text"></textarea></p>';
    echo '<p class="label"><label for="story_video"> Video Embed Link</label> <textarea name="story_video" type="text"></textarea></p>';
    echo '<input name="posted" type="hidden" value="posted"></p>';
    echo '<input name="status" type="hidden" value="ACTV"></p>';
    echo '<p class="label"><label for="submit"></label> <input name="Submit" type="Submit">';
    echo '</form>';
?>
</div>
-->









<div id="performer-box">

<h2>Performer List</h2>
<?php

echo '<table class="backstage">';

if(ISSET($_GET['page_number'])){
  $page = $_GET['page_number'];
}
else{
  $page = 0;
}

$result = mysqli_query($connection_string, "SELECT count(*) FROM Performers");
$row = mysqli_fetch_row($result);
$total_artists = $row[0];

$start_page = 10 * $page;

$last_page = floor($total_artists / 10);

$sql = "SELECT * FROM `Performers` WHERE `Status` = 'ACTV' ORDER BY `PerformerFirstName` LIMIT ".$start_page.",10";
    
if($result = mysqli_query($connection_string, $sql)){
          
  while($row = mysqli_fetch_array($result)){
    echo '<tr><td><a href="container.php?action=performer&context=view&performer='.$row['PerformerID'].'">'.$row['PerformerFirstName'].' '.$row['PerformerLastName'].'</a></td></tr>';
    
    // COMMENTING OUT SPRITES  //   <td><span class="view-sprite"> </span></td> <td><span class="delete-sprite"> </span> </td> <td><span class="delete-sprite"> </span></td></tr>';
  
  }
}
else{
  $artists = die('Error: ' . mysqli_error($connection_string));
}

if($page == 0){
  $page++;
  $url = '<a href="home.php?page_number='.$page.'">Next ---></a>';
}
elseif($last_page <= $page){
  $page--;
  $url = '<a href="home.php?page_number='.$page.'"><--- Previous</a>';
}
else{
  $prev_page = $page - 1;
  $next_page = $page + 1;
  $url = '<a href="home.php?page_number='.$prev_page.'"><--- Previous</a>'.' '.'<a href="home.php?page_number='.$next_page.'">Next ---></a>';
}
echo '<tr><td colspan="4">'.$url.'</td></tr>';
echo '</table>';

?>

</div>

<p class="clear-float"><span class="clear-float">&nbsp;</span></p>

<!--
<?php
  $show_id = 000001;
  show_order($show_id);
?>
-->
</div>
<?php
  include 'footer.php';
?>

</div>
</body>
</html>