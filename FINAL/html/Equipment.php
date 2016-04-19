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
<!-- Allows Equipment to be Added to the Equipment Table -->
<html>
<hr>
<P>

<form action=Equipment.php method=post>
<pre>
<!-- Textboxes to input a new record -->
        New Equipment Info:
        Name          <input type=text name="Name">
        Serial_number <input type=text name="Serial_number">
       <input type=submit value="Add Record">
<!-- output table for crud -->
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Equipment
<tr>
<td bgcolor=green>Id
<td bgcolor=green>Name
<td bgcolor=yellow>Update Name
<td bgcolor=green>Serial_number
<td bgcolor=yellow>Update Serial_number
<td bgcolor=red>Delete
<!--end of table -->

<?php //php begins here
// connect the database
require_once ('connection.php');
   
   //If the form has data, then insert a new record
   if (isset($_POST['Name']))
{
//trim input to prevent sql injections
   $Name= mysqli_real_escape_string($DBconn, trim($_POST['Name']));
   $Serial_number = mysqli_real_escape_string($DBconn, trim($_POST['Serial_number']));
   $query = "INSERT INTO Equipment VALUES (NULL,'$Name','$Serial_number')";
   $result = mysqli_query ($DBconn, $query);
  }
elseif (isset($_POST['remove']))
{
//if remove is set then delete the row with the correlated ID posted from hitting the delete button
//trim input to prevent sql injections
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Equipment WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query);
}
//change Name of Equipment if update was clicked and if post is not empty
elseif (isset($_POST['UpdateN']))
{
	if(!empty($_POST['UpdatedName']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateN']));
	$UpdateName= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedName']));
	$query = "UPDATE Equipment 
SET Name = \"$UpdateName\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedName']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Name');
}
}
//change Serial_number of Equipment if update was clicked and if post is not empty
elseif (isset($_POST['UpdateSN']))
{
	if(!empty($_POST['UpdatedSerial_number']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateSN']));
	$UpdateSerial_number= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedSerial_number']));
	$query = "UPDATE Equipment SET Serial_number = \"$UpdateSerial_number\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedSerial_number']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Serial_number');
}
}
// submit and process the query for exisiting Equipments
$query = "select * from Equipment;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
//generate query into the table
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Name");
//form to post from textbox input to update Name
   echo ("<form action=Equipment.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateN' value = $row->id>");  
   echo ("Change Name <input type=text name='UpdatedName'>");
   echo "</form>";
//form to post from textbox input to update serial_number
   echo("<td> $row->Serial_number");
   echo ("<form action=Equipment.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateSN' value = $row->id>");  
   echo ("Change Serial_number <input type=text name='UpdatedSerial_number'>");
   echo "</form>";
//form to create the delete button to remove a row from the database and crud
   echo ("<form action=Equipment.php method =post>");
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
<form action=Equipment.php method=post>
<pre>
<!-- Textboxes to input a new record -->
	New Equipment Info:
	Name          <input type=text name="Name">
	Serial_number <input type=text name="Serial_number">
       <input type=submit value="Add Record">
<a href ="Administrator.php">Back To Administration </a>
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
