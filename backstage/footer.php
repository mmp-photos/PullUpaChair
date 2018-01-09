<div id="footer">

<hr>

<p class="footer">All content &copy; <?php echo date("Y");?> Pull Up A Chair.</p>

</div>

<div id="menu">

  <p><img onclick="ShowDiv();" src="images/menu.png" alt="navigation" id="mobile_nav"></p>
  <div id="top_nav" onclick="HideDiv();">
  <?php
    include 'navigation.php';
  ?>
  </div>
  <div id="main_nav">
    <?php
      include 'navigation.php';
    ?>
  </div>
</div>