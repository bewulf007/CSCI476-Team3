<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=White colspan=8 align=center><font color=Black>Student Report
<tr>
<td bgcolor=White>First Name
<td bgcolor=White>Last Name
<td bgcolor=White>Equipment



<?php
// connect the database
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_morriss11 : " . mysql_error());

$query = "SELECT * from Equipment;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   echo ("<tr> <td> $row->Fname");
   echo("<td> $row->Lname");
   echo ("<td> $row->Name");
}

echo ("</table>");
echo ("<button onclick=history.go(-1);>Back </button>");


?>
