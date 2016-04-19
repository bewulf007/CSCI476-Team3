<?php
 session_start();
 if(!empty($_POST['username'])){
 $_SESSION['username'] = strtolower($_POST['username']);
 }
 if(!empty($_POST['password'])){
 $_SESSION['password'] = $_POST['password'];
 }
require("vendor/autoload.php");
use Adldap\Adldap;
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
try
{
    $ad = new Adldap($configuration);
} catch(AdldapException $e)
{
    echo "Uh oh, looks like we had an issue trying to connect: $e";
}
$authUser=false;
if(!empty($_POST['username']) && !empty($_POST['password']) && $_SESSION['username'] == "visitor" ){
$authUser = $ad->authenticate($_SESSION['username'], $_SESSION['password']);
}
if($authUser==true) { ?>
<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Allows Students to be Added to the Student Table -->
<html>
<hr>
<!--table for output -->
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>Id
<td bgcolor=green>Fname
<td bgcolor=yellow>Update Fname
<td bgcolor=green>Lname
<td bgcolor=yellow>Update Lname
<td bgcolor=green>AddressID
<td bgcolor=yellow>Update Address ID
<td bgcolor=green>Email
<td bgcolor=yellow>Update Email
<td bgcolor=green>Phone
<td bgcolor=yellow>Update Phone
<td bgcolor=red>Delete

<!--end of table -->

<?php //php begins here
// connect the database
require_once ('connection.php');
   
   //If the form has data, then insert a new record
   if (isset($_POST['Fname']))
  {
//trim input to prevent sql injections
   $Fname= mysqli_real_escape_string($DBconn, trim($_POST['Fname']));
   $Lname = mysqli_real_escape_string($DBconn, trim($_POST['Lname']));
   $AddressID= mysqli_real_escape_string($DBconn, trim($_POST['AddressID']));
   $Email= mysqli_real_escape_string($DBconn, trim($_POST['Email']));
   $Phone= mysqli_real_escape_string($DBconn, trim($_POST['Phone']));
   $query = "INSERT INTO Parent VALUES (NULL,'$Fname','$Lname','$AddressID','$Email','$Phone')";
   $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
  }
//if post remove is set delete the row with the id == remove
elseif (isset($_POST['remove']))
{
//trim input to prevent sql injections
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Parent WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
//change Fname of Parent if update was clicked and if post is not empty
elseif (isset($_POST['UpdateFN']))
{
	if(!empty($_POST['UpdatedFname']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateFN']));
	$UpdateFname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedFname']));
	$query = "UPDATE Parent SET Fname = \"$UpdateFname\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedFname']))
{
	throw new InvalidArgumentException('Invalid Fname');
}
}
//change Lname of Parent if update was clicked and if post is not empty
elseif (isset($_POST['UpdateLN']))
{
	if(!empty($_POST['UpdatedLname']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateLN']));
	$UpdateLname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedLname']));
	$query = "UPDATE Parent SET Lname = \"$UpdateLname\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedLname']))
{
	throw new InvalidArgumentException('Invalid Lname');
}
}
//change AddressID of Parent if update was clicked and if post is not empty
elseif (isset($_POST['UpdateA']))
{
	if(!empty($_POST['UpdatedAddressID']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateA']));
	$UpdateAddressID= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedAddressID']));
	$query = "UPDATE Parent SET AddressID = \"$UpdateAddressID\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedAddressID']))
{
	throw new InvalidArgumentException('Invalid AddressID');
}
}
//change Email of Parent if update was clicked and if post is not empty
elseif (isset($_POST['UpdateE']))
{
	if(!empty($_POST['UpdatedEmail']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateE']));
	$UpdateEmail= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedEmail']));
	$query = "UPDATE Parent SET Email = \"$UpdateEmail\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedEmail']))
{
	throw new InvalidArgumentException('Invalid Email');
}
}
//change Phone of Parent if update was clicked and if post is not empty
elseif (isset($_POST['UpdateP']))
{
	if(!empty($_POST['UpdatedPhone']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateP']));
	$UpdatePhone = mysqli_real_escape_string($DBconn, trim($_POST['UpdatedPhone']));
	$query = "UPDATE Parent SET Phone = \"$UpdatePhone\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedPhone']))
{
	throw new InvalidArgumentException('Invalid Phone');
}
}
// submit and process the query for exisiting Parents
$query = "select * from Parent;";
$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
//form to post from textbox input to update Fname
   echo("<td> $row->Fname");
   echo ("<form action=Parent.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateFN' value = $row->id>");  
   echo ("Change Fname <input type=text name='UpdatedFname'>");
   echo "</form>";
//form to post from textbox input to update Lname
   echo("<td> $row->Lname");
   echo ("<form action=Parent.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateLN' value = $row->id>");  
   echo ("Change Lname <input type=text name='UpdatedLname'>");
   echo "</form>";
//form to post from textbox input to update AddressID
   echo ("<td> $row->AddressID");
   echo ("<form action=Parent.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateA' value = $row->id>");  
   echo ("Change AddressID <input type=text name='UpdatedAddressID'>");
   echo "</form>";
//form to post from textbox input to update Email
   echo ("<td> $row->Email");
   echo ("<form action=Parent.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateE' value = $row->id>");  
   echo ("Change Email <input type=text name='UpdatedEmail'>");
   echo "</form>";
//form to post from textbox input to update Phone
   echo ("<td> $row->Phone");
   echo ("<form action=Parent.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateP' value = $row->id>");  
   echo ("Change Phone <input type=text name='UpdatedPhone'>");
   echo "</form>";
//form to create the delete button to remove a row from the database and crud
   echo ("<form action=Parent.php method =post>");
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

<form action=Parent.php method=post>
<pre>
<!-- Textboxes to input a new record -->
       New Parent Info:
        Fname <input type=text name="Fname">
	Lname <input type=text name="Lname">
	AddressID <input type=text name="AddressID">
	Email <input type=text name="Email">
	Phone <input type=text name="Phone">
       <input type=submit value="Add Record">
<a href ="JoinedTable.php"> Addresses And Zips Table </a>
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
