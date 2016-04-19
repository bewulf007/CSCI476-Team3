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
<!-- Allows Addresses to be Added to the Address Table -->

<html>
<hr>
<P>
<form action=Address.php method=post>
<pre>
<!-- Textboxes to input a new record -->
       New Address Info:
        Street <input type=text name="Street">
        City   <input type=text name="City">
        State  <input type=text name="State">
        Zip    <input type=text name="Zip">
       <input type=submit value="Add Record">
<!--create table for crud to be displayed -->
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>id
<td bgcolor=green>Street
<td bgcolor=yellow>Update Street
<td bgcolor=green>City
<td bgcolor=yellow>Update City
<td bgcolor=green>State
<td bgcolor=yellow>Update State
<td bgcolor=green>Zip
<td bgcolor=yellow>Update Zip
<td bgcolor=red>Delete

<!-- end of table code -->

<!--php code begins here -->
<?php
// connect the database
require_once ('connection.php');

// if the form has data input, then insert a new record
if (isset($_POST['Street']))
  {
//trim all input to prevent SQL injections
   $Street= mysqli_real_escape_string($DBconn, trim($_POST['Street']));
   $City = mysqli_real_escape_string($DBconn, trim($_POST['City']));
   $State= mysqli_real_escape_string($DBconn, trim($_POST['State']));
   $Zip= mysqli_real_escape_string($DBconn, trim($_POST['Zip']));
   $query = "INSERT INTO Address VALUES (NULL,'$Street','$City','$State','$Zip')";
   $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
  }
//if remove is posted (the delete button was hit) then remove the row from the database
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Address WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
//change street of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateS']))
{
	if(!empty($_POST['UpdatedStreet']))
{
//trim all input to prevent SQL injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateS']));
	$UpdateStreet= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedStreet']));
	$query = "UPDATE Address SET Street = \"$UpdateStreet\" WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedStreet']))
{
	throw new InvalidArgumentException('Invalid Street');
}
}
//change city of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateC']))
{
	if(!empty($_POST['UpdatedCity']))
{
//trim all input to prevent SQL injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateC']));
	$UpdateCity= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedCity']));
	$query = "UPDATE Address SET City = \"$UpdateCity\" WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedCity']))
{
	throw new InvalidArgumentException('Invalid City');
}
}
//change state of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateST']))
{
	if(!empty($_POST['UpdatedState']))
{
//trim all input to prevent SQL injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateST']));
	$UpdateState= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedState']));
	$query = "UPDATE Address SET State = \"$UpdateState\" WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedState']))
{
	throw new InvalidArgumentException('Invalid State');
}
}
//change zip of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateZ']))
{
	if(!empty($_POST['UpdatedZip']))
{
//trim all input to prevent SQL injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateZ']));
	$UpdateZip = mysqli_real_escape_string($DBconn, trim($_POST['UpdatedZip']));
	$query = "UPDATE Address SET Zip = $UpdateZip WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedZip']))
{
	throw new InvalidArgumentException('Invalid Zip');
}
}
// submit and process the query for existing Addresses
$query = "select * from Address;";
$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
//form to create the update street button and the text box for input
   echo("<td> $row->Street");
   echo ("<form action=Address.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateS' value = $row->id>");  
   echo ("Change Street <input type=text name='UpdatedStreet'>");
   echo "</form>";
//form to create the update city button and the text box for input
   echo("<td> $row->City");
   echo ("<form action=Address.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateC' value = $row->id>");  
   echo ("Change City <input type=text name='UpdatedCity'>");
   echo "</form>";
//form to create the update state button and the text box for input
   echo ("<td> $row->State");
   echo ("<form action=Address.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateST' value = $row->id>");  
   echo ("Change State <input type=text name='UpdatedState'>");
   echo "</form>";
//form to create the update zip button and the text box for input
   echo ("<td> $row->Zip");
   echo ("<form action=Address.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateZ' value = $row->id>");  
   echo ("Change Zip <input type=text name='UpdatedZip'>");
   echo "</form>";
//form to create the delete button to remove a row from the database and crud
   echo ("<form action=Address.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
}
//end of php
?>

</table>
<P>
<hr>
<P>

<form action=Address.php method=post>
<pre>
<!-- Textboxes to input a new record -->
       New Address Info:
        Street <input type=text name="Street">
	City   <input type=text name="City">
	State  <input type=text name="State">
	Zip    <input type=text name="Zip">
       <input type=submit value="Add Record">
<!-- link back to administrator page -->
<a href ="Administrator.php"> Back To Administration </a>
</pre>
</form>
<P>
<hr>
</html>
<?php
}else{ ?>
<P>
<a href="admin.php">Password incorrect. Try again?</a>
</P>
<?php
}
?>
