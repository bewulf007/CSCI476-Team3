<?php
//The security ties in with LDAP using session variables, initialize the session:
session_start();

//LDAP requires/namespaces
require("vendor/autoload.php");
use Adldap\Adldap;

//Declares the Adldap array pointed at Winthrop's auth. server
$configuration = array(
    'account_suffix' => '@winthrop.edu',
    'domain_controllers' => array("rahway.winthrop.edu"),
    'base_dn' => 'DC=win, DC=winthrop, DC=edu',
    'real_primarygroup' => true,
    'use_ssl' => false,
    'recursive_groups' => true,
    'ad_port' => '636',
    'sso' => false,
);
//Uses built-in error handling to detect issues connecting
try
{
    $ad = new Adldap($configuration);
} catch(AdldapException $e)
{
    echo "Uh oh, looks like we had an issue trying to connect: $e";
}

//Default to false, assume auth failed unless proven otherwise
$authUser=false;
if($_SESSION['username'] == "visitor" ){
//Authentication status depends on success/failure of submission, using session authentications
$authUser = $ad->authenticate($_SESSION['username'], $_SESSION['password']);
}
//if we succeeded, render the admin page:
if($authUser==true) { ?>
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
}?>
<?php
}else{ ?>
<P>
<a href="admin.php">Password incorrect. Try again?</a>
</P>
<?php
}
?>
