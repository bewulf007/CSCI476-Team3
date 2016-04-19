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
<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Displays a list of Equipment -->
<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=White colspan=2 align=center><font color=Black>Equipment Report
<tr>
<td bgcolor=White>Name
<td bgcolor=White>Serial Number

<?php
// connect the database
require_once ('connection.php');

$query = "select * from Equipment;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->Name");
   echo ("<td> $row->Serial_number");
}

echo ("</table>");
echo ("<button onclick=history.go(-1);>Back </button>");
?>
<?php
}else{ ?>
<P>
<a href="admin.php">Password incorrect. Try again?</a>
</P>
<?php
}
?>
