
<html>
<hr>
<!-- output table for report -->
<table rules=all border=10>
<tr>
<td bgcolor=White colspan=8 align=center><font color=Black>Instructor Report
<tr>
<td bgcolor=White>First Name
<td bgcolor=White>Last Name
<td bgcolor=White>Email
<td bgcolor=White>Phone
<td bgcolor=White>Building
<td bgcolor=White>Office
<td bgcolor=White>Camp

<!--end of table -->

<?php //php begins here
// connect the database
require_once ('connection.php');
//query to create report
$query = "SELECT Instructor.Fname, Instructor.Lname, Instructor.Email, Instructor.Phone, Instructor.Building, Instructor.Office, Camp.Name FROM Instructor JOIN Camp WHERE Instructor.id=Camp.Instructor_id;
";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
//generate query into the table
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

