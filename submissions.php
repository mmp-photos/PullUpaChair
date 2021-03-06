<?php
// Start the session

// Includes

include_once("connection_string.php");
include_once("puac_functions.php");
include_once("functions/submissions_functions.php");

// Check for errors passed in the URL

if(ISSET($_GET['error'])){

  $error_message = check_error($_GET['error']);

}

$show_id = GetShowID($current_date, $connection_string);
  
if(ISSET($_POST['posted'])){
  $posted = $_POST;
  $error = submission($posted);

// Insert data into Database //

if(!ISSET($error['edit'])){
  $state = 'insert';
  if($state== 'insert'){
    InsertSubmission($error, $posted, $connection_string, $show_id);
    MailSubmission($error, $posted);
    $state = 'confirm';
  }
}
else{
  $state = '';
}
  

// Determine State of Page to Be Displayed //
if(ISSET($error['edit'])){
  $state = 'edit';
  }
}
else{
  $state = 'input';
}
?>

<!DOCTYPE HTML>
<html>
<head>

<title>Pull Up a Chair</title>


<meta charset="utf-8"/>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="mobile_styles.css">

<link href="https://fonts.googleapis.com/css?family=Cutive|Libre+Baskerville" rel="stylesheet">


<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
</style>

<?php include_once("images/src/analyticstracking.php") ?>
<?php include_once("connection_string.php");  ?>


<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us14.list-manage.com","uuid":"6ad24823f857114a9745331cf","lid":"6fde46fd16"}) })</script>


<script type="text/javascript">
function HideDiv() {
		document.getElementById('top_nav').style.display = "none";
		document.getElementById('turn_off_nav').style.display = "none";
}
function ShowDiv() {
		document.getElementById('top_nav').style.display = "block";
		document.getElementById('turn_off_nav').style.display = "block";
}
</script>


<script type="text/javascript">

var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
</script>

<script type="text/javascript">
if(isMobile == true){

  var Style = '<link rel="stylesheet" type="text/css" href="mobile_styles.css">';
  var Logo  = '<img class="main" alt="logo" src="images/masthead_small.jpg"><br /><img class="tagline" src="images/tagline.png">';

}

else{

  var Style = '<link rel="stylesheet" type="text/css" href="mobile_styles.css">';
  var Logo  = '<img class="main" alt="logo" src="images/masthead_large.jpg">';

}

document.write(Style);
</script>


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

<!-- Additional Scripting -->

<div id="upcoming">
<p class="calendar_month">Submitting For</p>
<?php
  $formatted_date = next_show($current_date, $connection_string);  
?>
</div>
<div>

<!-- Body Copy -->

<div id="right_column">
<h1>Submit a Story</h1>

<!-- Begin Submission Form -->

<?php
  
  if($state == "edit"){
    SubmissionErrors($error, $_POST, $show_id);
  }
  elseif($state == 'confirm'){
    VerificationPage($error, $posted);
  }
  elseif($state == 'input'){
    SubmissionForm($show_id);
  }
?>
</div>
<p class="clear">&nbsp;</p>

<hr>

<?php

  include 'footer.php';

?>
</div>
</body>
</html>