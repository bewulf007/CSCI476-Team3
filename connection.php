<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Allows Addresses to be Added to the Address Table -->

<?php
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
if (!$db_selected)
   die ("Can't use my_morriss11 : " . mysqli_error());
?>
