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

$query = "SELECT Student.Fname, Student.Lname, Camp.Name, Emerge.Fname AS EFname, Emerge.Lname AS ELname, Emerge.Phone FROM Student JOIN Camp ON Student.Camp_id=Camp.id JOIN Emerge ON Student.Emerge_id=Emerge.id;";
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

