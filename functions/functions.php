function NextShow($current_date, $connection_string){
  echo '<div id="show_box_index">';
  echo '<div id="upcoming_index">';
  echo '<p class="next_show">Next Show</p>';
  $formatted_date = next_show($current_date, $connection_string);
  echo '</div>';
  // COMMENTING OUT THE SUBMISSION LINE --->   echo '<p><a class="submission" href="submissions.php">Submit A Story</a></p>';
  echo '<p class="tickets"><a class="submission" href="http://www.brownpapertickets.com/event/3040850">Tickets</a></p>';
  echo '</div>';
}