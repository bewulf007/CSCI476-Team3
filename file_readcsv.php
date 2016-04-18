<?php
error_reporting(0);
if(!$file)
//input for the file name
echo 'Please enter a valid file name: ';

//Requests a file name to send to readcsv.php
echo "<form action=\"readcsv.php\" method=\"post\">
File Name: <input type=\"text\" name=\"file\"><br>
<input type=\"submit\" value=\"Accept\">";
//if a file is post then open the file
if(isset($_POST['file']))
{
$file = $_POST['file'];

echo "<br><br>You entered:<br>" . $file;
}
?>
