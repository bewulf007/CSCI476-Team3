<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=White colspan=8 align=center><font color=Black>Student Report
<tr>
<td bgcolor=White>First Name
<td bgcolor=White>Last Name
<td bgcolor=White>Email
<td bgcolor=White>Phone
<td bgcolor=White>Building
<td bgcolor=White>Office
<td bgcolor=White>Camp


<?php
// connect the database
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_morriss11 : " . mysql_error());

//get Instructor first name, last name, email, phone, building, and office for reporting purposes
$query = "SELECT Instructor.Fname, Instructor.Lname, Instructor.Email, Instructor.Phone, Instructor.Building, Instructor.Office, Camp.Name FROM Instructor JOIN Camp WHERE Instructor.id=Camp.Instructor_id;
";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   echo ("<tr> <td> $row->Fname");
   echo("<td> $row->Lname");
   echo ("<td> $row->Email");
   echo ("<td> $row->Phone");
   echo ("<td> $row->Building");
   echo ("<td> $row->Office");
   echo ("<td> $row->Name");
}
echo ("</table>");
echo ("<button onclick=history.go(-1);>Back </button>");


?>

