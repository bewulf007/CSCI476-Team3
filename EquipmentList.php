<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Displays a list of Equipment -->
<html>
<hr>
<!-- output table for crud -->
<table rules=all border=10>
<tr>
<td bgcolor=White colspan=8 align=center><font color=Black>Equipment Report
<tr>
<td bgcolor=White>Name

<!--end of table -->

<?php //php begins here
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
//exception if database cannot connect throw error message
if (!$db_selected)
   die ("Can't use my_morriss11 : " . mysqli_error());
//query to create report
$query = "select * from Equipment;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
//generate query into the table
   echo ("<tr> <td> $row->Name");
}

echo ("</table>");
echo ("<button onclick=history.go(-1);>Back </button>");

?>
