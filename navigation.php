<ul>
  <li><a class="nav" href="index.php">Home</a></li>
  <li><a class="nav" href="about.php">About</a></li>
  <li><a class="nav" href="contact.php">Contact</a></li>
  <li><a class="nav" href="show.php">Shows</a></li>
  <li><a class="nav" href="video.php">Videos</a></li>
  <li><a class="nav" href="performer.php">Storytellers</a></li>
  <?php
    $show->SubmissionLinkNav($current_date);
    $show->TicketLinkNav($current_date);
  ?>
</ul>