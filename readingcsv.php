<?php
require_once ('connection.php');

//require once the file_readingcsv.php
require_once ('file_readingcsv.php');
$row = 0;
if($file)
//open the file for read
if (($handle = fopen($file, "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    $row++;

//skip the first two rows/lines as they contain garbage data
if($row > 2)
{
    for ($c=0; $c < $num; $c++)
{
	$data[$c];
}
//data put into array moved to variable for easier readability
$sfname = $data[11];
$slname = $data[12]; 
$pfname = $data[13]; 
$plname = $data[14]; 
$essay = $data[15];
//query to insert the values into the scholarship table  
$query = "INSERT INTO Scholarship VALUES (NULL,'$sfname','$slname','$pfname','$plname','$essay')";
$result = mysql_query ($query, $DBconn);

}}
    
  fclose($handle);
//close the file
echo "<P>";
echo 'File has been read';
}
