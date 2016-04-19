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
<?php
}else{ ?>
<P>
<a href="admin.php">Password incorrect. Try again?</a>
</P>
<?php
}
?>
