<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Displays Demographic Information for Students -->
<html>
<hr>
<!-- output table for report -->
<table rules=all border=10>
<tr>
<td bgcolor=White colspan=8 align=center><font color=Black>Student Report
<tr>
<td bgcolor=White>First Name
<td bgcolor=White>Last Name
<td bgcolor=White>School
<td bgcolor=White>Grade
<td bgcolor=White>Gender
<td bgcolor=White>Ethnicity
<td bgcolor=White>City
<td bgcolor=White>State
<td bgcolor=White>Camp

<!--end of table -->

<?php //php begins here
// connect the database
require_once ('connection.php');
//query to create report
$query = "SELECT DISTINCT Student.Fname, Student.Lname, Student.School, Student.Grade, Student.Gender, Student.Ethnicity, Address.City, Address.State, Camp.Name FROM Student JOIN Address ON Student.Address_id=Address.id JOIN Campers ON Student.id=Campers.Student_id JOIN Camp ON Campers.Camp_id=Camp.id;";

$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
while ($row = mysqli_fetch_object ($result))
{
//generate query into the table
   echo ("<tr> <td> $row->Fname");
   echo("<td> $row->Lname");
   echo ("<td> $row->School");
   echo ("<td> $row->Grade");
   echo ("<td> $row->Gender");
   echo ("<td> $row->Ethnicity");
   echo("<td> $row->City");
   echo ("<td> $row->State");
   echo("<td> $row->Name");
}
echo ("</table>");
echo ("<button onclick=history.go(-1);>Back </button>");
?>
