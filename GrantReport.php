<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Displays Grant_Report Table -->
<html>
<hr>
<!-- output table for report -->
<table rules=all border=10>
<tr>
<td bgcolor=White colspan=8 align=center><font color=Black>Grant Info Report
<tr>
<td bgcolor=White>First Name
<td bgcolor=White>Last Name
<td bgcolor=White>Amount
<td bgcolor=White>Phone
<td bgcolor=White>Email

<!--end of table -->

<?php //php begins here
// connect the database
require_once ('connection.php');
//query to create report
$query = "SELECT Grant_info.Fname, Grant_info.Lname, Grant_info.Amount, Grant_info.Phone, Grant_info.Email FROM Grant_info;";
$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
while ($row = mysqli_fetch_object ($result))
{
//generate query into the table
   echo ("<tr> <td> $row->Fname");
   echo("<td> $row->Lname");
   echo ("<td> $row->Amount");
   echo ("<td> $row->Phone");
   echo ("<td> $row->Email");
}

echo ("</table>");
echo ("<button onclick=history.go(-1);>Back </button>");
?>
