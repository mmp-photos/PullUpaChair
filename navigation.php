<ul>
  <li><a class="nav" href="index.php">Home</a></li>
  <li><a class="nav" href="about.php">About</a></li>
  <li><a class="nav" href="contact.php">Contact</a></li>
  <li><a class="nav" href="show.php">Shows</a></li>
  <li><a class="nav" href="video.php">Videos</a></li>
  <?php
    TicketLink($current_date, $connection_string);
  ?>
</ul>