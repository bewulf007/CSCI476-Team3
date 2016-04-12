<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=White colspan=8 align=center><font color=Black>Grant Info Report
<tr>
<td bgcolor=White>First Name
<td bgcolor=White>Last Name
<td bgcolor=White>Amount
<td bgcolor=White>Phone
<td bgcolor=White>Email



<?php
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
if (!$db_selected)
   die ("Can't use my_morriss11 : " . mysqli_error());
//get first name, last name, amount, phone, email from grant info table for reporting
$query = "SELECT Grant_info.Fname, Grant_info.Lname, Grant_info.Amount, Grant_info.Phone, Grant_info.Email FROM Grant_info;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->Fname");
   echo("<td> $row->Lname");
   echo ("<td> $row->Amount");
   echo ("<td> $row->Phone");
   echo ("<td> $row->Email");
}
echo ("</table>");
echo ("<button onclick=history.go(-1);>Back </button>");
?>
