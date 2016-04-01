<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=white colspan=1 align=center><font color=black>

<?php
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_morriss11 : " . mysql_error());
$row = 1;

//request file to read from
require_once('file.php');
error_reporting(0);
//Check if a file name has been entered
if($file)
{

if (($handle = fopen("/home/ACC.morriss11/public_html/$file", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
if($row >=5)
{
    for ($c=0; $c < $num; $c++) {
	$data[$c];
        //echo $data[$c] . "<br />\n";
    }
         //address information
	 //echo $data[26] . "<br />\n";
	 //echo $data[27] . "<br />\n";
         //echo $data[28] . "<br />\n";
         //echo $data[29] . "<br />\n";
         //emergency information
         //echo $data[32] . "<br />\n";
	 //echo $data[33] . "<br />\n";
         //echo $data[34] . "<br />\n";
         //echo $data[35] . "<br />\n";
         //parent info
         //echo $data[22] . "<br />\n";
	 //echo $data[23] . "<br />\n";
         //echo $data[24] . "<br />\n";
         //echo $data[25] . "<br />\n";
	//student info
	 //echo $data[10] . "<br />\n"; //fbane
	 //echo $data[11] . "<br />\n";//lname
         //echo $data[16] . "<br />\n";//grade
         //echo $data[17] . "<br />\n";//school
	 //echo $data[18] . "<br />\n";//gen
	 //echo $data[19] . "<br />\n";//eth
         //echo $data[21] . "<br />\n";//shisiz
         //echo $data[30] . "<br />\n";//sp
	 //echo $data[31] . "<br />\n";//np
	
$query = "INSERT INTO Address VALUES (NULL,'$data[26]','$data[27]','$data[28]','$data[29]')";
$result = mysql_query ($query, $DBconn);
$query1 = "INSERT INTO Emerge VALUES (NULL,'$data[32]','$data[33]','$data[34]','$data[35]')";
$result = mysql_query ($query1, $DBconn);
//echo $data[26];
$query2 = "Select id From Address Where Street = '$data[26]'";
$result1 = mysql_query ($query2, $DBconn);
if (!$result1) {
	echo 'nope' . mysql_error();}
$AddressId = mysql_fetch_row($result1);
//echo $AddressId[0];
//echo "<P>";
//echo $data[36];
//echo $data[37];
//echo $row[1];
$query = "INSERT INTO Parent VALUES (NULL,'$data[22]','$data[23]',$AddressId[0],'$data[24]','$data[25]')";
$result = mysql_query ($query, $DBconn);
$query4 = "Select id From Parent Where Email = '$data[24]'";
$result2 = mysql_query ($query4, $DBconn);
if (!$result2) {
	echo 'nope' . mysql_error();}
$ParentId = mysql_fetch_row($result2);
//echo $ParentId[0];
$query5 = "Select id From Emerge Where Email = '$data[34]'";
$result3 = mysql_query ($query5, $DBconn);
if (!$result3) {
	echo 'nope' . mysql_error();}
$EmergId = mysql_fetch_row($result3);
//echo $EmergId[0];
$query6 = "INSERT INTO Student VALUES (NULL,'$data[10]','$data[11]',$AddressId[0],'$data[21]','$data[17]',$ParentId[0],'$data[16]','$data[18]','$data[19]','$data[30]','$data[31]',$EmergId[0])";
$result = mysql_query ($query6, $DBconn);
$query7 = "Select id From Student Where Fname = '$data[10]' and Lname = '$data[11]'";
$result4 = mysql_query ($query7, $DBconn);
if (!$result4) {
	echo 'nope' . mysql_error();}
$StudentId = mysql_fetch_row($result4);

echo $StudentId[0];
$query12 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=1";
$result9 = mysql_query ($query12, $DBconn);
if (!$result9) {
	echo 'nope' . mysql_error();}
$camp1count = mysql_fetch_row($result9);

$query13 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=2";
$result10 = mysql_query ($query13, $DBconn);
if (!$result10) {
	echo 'nope' . mysql_error();}
$camp2count = mysql_fetch_row($result10);
$query14 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=3";
$result11 = mysql_query ($query14, $DBconn);
if (!$result11) {
	echo 'nope' . mysql_error();}
$camp3count = mysql_fetch_row($result11);
$query15 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=4";
$result12 = mysql_query ($query15, $DBconn);
if (!$result12) {
	echo 'nope' . mysql_error();}
$camp4count = mysql_fetch_row($result12);
//---------------------------JEWEL-----------------------------------------------------------
if ($data[36] == "Computing and Jewelry Design Cost: $125 July 7 - 11")
{
$query12 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=1";
$result9 = mysql_query ($query12, $DBconn);
}
if (!$result9) {
	echo 'nope' . mysql_error();}
$camp1count = mysql_fetch_row($result9);
echo "<P>";
echo "Count =";
echo $camp1count[0];
if ($camp1count[0] < 20 and $data[36] == "Computing and Jewelry Design Cost: $125 July 7 - 11")
{
$query8 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],1)";
$result5 = mysql_query ($query8, $DBconn);
}
else if ($data[36] == "Computing and Jewelry Design Cost: $125 July 7 - 11"and $camp1count[0] >= 20)
{
$query8 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],1)";
$result5 = mysql_query ($query8, $DBconn);
}
//-------------------------------ROBOT-----------------------------------------------------------
if ($data[37] == "Computing and Robotics Cost $125 July 14 -18")
{
$query13 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=2";
$result10 = mysql_query ($query13, $DBconn);
}
if (!$result10) {
	echo 'nope' . mysql_error();}
$camp2count = mysql_fetch_row($result10);
echo "<P>";
echo "Count =";
echo $camp2count[0];
if ($camp2count[0] < 20 and $data[37] == "Computing and Robotics Cost $125 July 14 -18")
{
$query9 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],2)";
$result6 = mysql_query ($query9, $DBconn);
}
else if ($data[37] == "Computing and Robotics Cost $125 July 14 -18"and $camp2count[0] >= 20)
{
$query9 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],2)";
$result6 = mysql_query ($query9, $DBconn);
}
//-----------------------------------Mobile-----------------------------------------------------
if ($data[38] == "Computing Mobile Apps Cost: $125 July 21 - 25")
{
$query14 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=3";
$result11 = mysql_query ($query14, $DBconn);
}
if (!$result11) {
	echo 'nope' . mysql_error();}
$camp3count = mysql_fetch_row($result11);
echo "<P>";
echo "Count =";
echo $camp3count[0];
if ($camp3count[0] < 20 and $data[38] == "Computing Mobile Apps Cost: $125 July 21 - 25")
{
$query10 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],3)";
$result7 = mysql_query ($query10, $DBconn);
}
else if ($data[38] == "Computing Mobile Apps Cost: $125 July 21 - 25"and $camp3count[0] >= 20)
{
$query10 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],3)";
$result7 = mysql_query ($query10, $DBconn);
}
//----------------------------------3-D-Print--------------------------------------------------------
if ($data[39] == "3-D Printing Cost $125")
{
$query15 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=4";
$result12 = mysql_query ($query15, $DBconn);
}
if (!$result12) {
	echo 'nope' . mysql_error();}
$camp4count = mysql_fetch_row($result12);
echo "<P>";
echo "Count =";
echo $camp4count[0];
if ($camp4count[0] < 20 and $data[39] == "3-D Printing Cost $125")
{
$query11 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],4)";
$result8 = mysql_query ($query11, $DBconn);
}
else if ($data[39] == "3-D Printing Cost $125"and $camp4count[0] >= 20)
{
$query11 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],4)";
$result8 = mysql_query ($query11, $DBconn);
}
//-----------------------------------------------------------------------------------------------------
/*if ($data[37] == "Computing and Robotics Cost $125 July 14 -18"and $camp2count[0] <= 20)
{
$query9 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],2)";
$result6 = mysql_query ($query9, $DBconn);
}
else if ($data[37] == "Computing and Robotics Cost $125 July 14 -18"and $camp2count[0] > 20)
{
$query9 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],2)";
$result6 = mysql_query ($query9, $DBconn);
}
if ($data[38] == "Computing Mobile Apps Cost: $125 July 21 - 25"and $camp3count[0] <= 20)
{
$query10 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],3)";
$result7 = mysql_query ($query10, $DBconn);
}
else if ($data[38] == "Computing Mobile Apps Cost: $125 July 21 - 25"and $camp3count[0] > 20)
{
$query10 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],3)";
$result7 = mysql_query ($query10, $DBconn);
}
if ($data[39] == "3-D Printing Cost $125"and $camp4count[0] <= 20)
{
$query11 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],4)";
$result8 = mysql_query ($query11, $DBconn);
}
else if ($data[39] == "3-D Printing Cost $125"and $camp4count[0] > 20)
{
$query11 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],4)";
$result8 = mysql_query ($query11, $DBconn);
}*/
 //$query8 = "Select id from Camp Where Name =
//$query = "INSERT INTO Address VALUES (NULL,'$data[25]','$data[26]','$data[27]','$data[28]')";
//$result = mysql_query ($query, $DBconn);
//$query = "INSERT INTO Address VALUES (NULL,'$data[25]','$data[26]','$data[27]','$data[28]')";
//$result = mysql_query ($query, $DBconn);
}}
  fclose($handle);
}
}
