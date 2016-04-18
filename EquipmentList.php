<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Displays a list of Equipment -->
<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=White colspan=2 align=center><font color=Black>Equipment Report
<tr>
<td bgcolor=White>Name
<td bgcolor=White>Serial Number

<?php
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysqli_error());

$query = "select * from Equipment;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->Name");
   echo ("<td> $row->Serial_number");
}

echo ("</table>");
echo ("<button onclick=history.go(-1);>Back </button>");
?>
