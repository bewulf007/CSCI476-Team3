<?php
error_reporting(0);
if(!$file)
echo 'Please enter a valid file name: ';
//Requests a file name to send to readcsv.php
echo "<form action=\"readcsv.php\" method=\"post\">
File Name: <input type=\"text\" name=\"file\"><br>
<input type=\"submit\" value=\"Accept\">";
if(isset($_POST['file']))
{
$file = mysqli_real_escape_string($DBconn, ($_POST['file']));
echo "<br><br>You entered:<br>" . $file;
}
?>
