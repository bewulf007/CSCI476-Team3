<html>
<hr>
<!-- output table for report -->
<table rules=all border=10>
<tr>
<td bgcolor=White colspan=8 align=center><font color=Black>Student Report
<tr>
<td bgcolor=White>First Name
<td bgcolor=White>Last Name
<td bgcolor=White>Camp
<td bgcolor=White>Emergency Contact Fname
<td bgcolor=White>Emergency Contact Lname
<td bgcolor=White>Emergency Contact Phone

<!--end of table -->

<?php //php begins here
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
//exception if database cannot connect throw error message
if (!$db_selected)
   die ("Can't use my_morriss11 : " . mysqli_error());
//get Student first name, last name, camp name, emergency first name, emergency last name, emergency phone for reporting purposes
$query = "SELECT Student.Fname, Student.Lname, Camp.Name, Emerge.Fname AS EFname, Emerge.Lname AS ELname, Emerge.Phone FROM Student JOIN Campers ON Student.id=Campers.Student_id JOIN Camp ON Campers.Camp_id=Camp.id JOIN Emerge ON Student.Emerge_id=Emerge.id;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
//generate query into the table
   echo ("<tr> <td> $row->Fname");
   echo("<td> $row->Lname");
   echo ("<td> $row->Name");
   echo ("<td> $row->EFname");
   echo ("<td> $row->ELname");
   echo ("<td> $row->Phone");
}
echo ("</table>");
echo ("<button onclick=history.go(-1);>Back </button>");
?>
