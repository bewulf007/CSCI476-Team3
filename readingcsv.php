<?php

$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_morriss11 : " . mysql_error());

require_once ('file_readingcsv.php');
$row = 0;
if($file)
if (($handle = fopen($file, "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;

if($row > 2)
{
    for ($c=0; $c < $num; $c++)
{
	$data[$c];
        echo $data[$c] . "<br />\n";
}
echo $data[11];
$sfname = $data[11];
$slname = $data[12]; 
$pfname = $data[13]; 
$plname = $data[14]; 
$essay = $data[15];  
echo $sfname;
echo $slname;
echo $pfname;
echo $plname;
echo $essay;
echo $data[12];
echo $data[13];
echo $data[14];
echo $data[15];
$query = "INSERT INTO Scholarship VALUES (NULL,'$sfname','$slname','$pfname','$plname','$essay')";
$result = mysql_query ($query, $DBconn);

}}
    
  fclose($handle);
}
