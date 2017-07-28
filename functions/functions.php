function NextShow($current_date, $connection_string){
  echo '<div id="show_box">';
  echo '<div id="upcoming_index">';
  echo '<p class="calendar_month">Next Show</p>';
  $formatted_date = next_show($current_date, $connection_string);
  echo '</div>';
  // COMMENTING OUT THE SUBMISSION LINE --->   echo '<p><a class="submission" href="submissions.php">Submit A Story</a></p>';
  echo '</div>';
}