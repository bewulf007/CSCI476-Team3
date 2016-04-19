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
<html>
<hr>
<P>

<form action=Signed_Equip.php method=post>
<pre>
<!-- Textboxes to input a new record -->
       New Signed_Equip:
        Student_Id <input type=text name="Student_Id">
        Equip_id   <input type=text name="Equip_id">
       <input type=submit value="Add Record">

<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>Id
<td bgcolor=green>Student_Id
<td bgcolor=yellow>Update Student_Id
<td bgcolor=green>Equip_Id
<td bgcolor=yellow>Update Equip_Id
<td bgcolor=red>Delete

<!--end of table -->

<?php //php begins here
// connect the database
require_once ('connection.php');

// if the form had data, then insert a new record
if (isset($_POST['Student_Id']))
  {
//trim input to prevent sql injections
   $Student_Id = mysqli_real_escape_string($DBconn, trim($_POST['Student_Id']));
   $Equip_id= mysqli_real_escape_string($DBconn, trim($_POST['Equip_id']));
   $query = "INSERT INTO Signed_Equip VALUES (Null,$Student_Id,$Equip_id)";
   $result = mysqli_query ($DBconn, $query);
  }
//if post remove is set delete the row with the id == remove
elseif (isset($_POST['remove']))
{
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Signed_Equip WHERE ID = \"$remove\"";
	$result = mysqli_query ($DBconn, $query);
}

//change Student_Id of Signed_Equip if update was clicked and if post is not empty
elseif (isset($_POST['UpdateT']))
{
	if(!empty($_POST['UpdatedStudent_Id']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateT']));
	$UpdateStudent_Id= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedStudent_Id']));
	$query = "UPDATE Signed_Equip SET Student_Id = \"$UpdateStudent_Id\" WHERE ID = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedStudent_Id']))
{
	throw new InvalIdArgumentException('InvalId Student_Id');
}

}

//change Student_Id of Signed_Equip if update was clicked and if post is not empty
elseif (isset($_POST['UpdateD']))
{
	if(!empty($_POST['UpdatedEquip_id']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateD']));
	$UpdateEquip_id= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedEquip_id']));
	$query = "UPDATE Signed_Equip SET Equip_id = $UpdateEquip_id WHERE ID = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedEquip_id']))
{
	throw new InvalIdArgumentException('InvalId Equip_id');
}

}

// submit and process the query for existing Students
$query = "select * from Signed_Equip;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->ID");
//form to post from textbox input to update Student_ID
   echo("<td> $row->Student_Id");
   echo ("<form action=Signed_Equip.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hIdden' name ='UpdateT' value = $row->ID>");  
   echo ("Change Student_Id <input type=text name='UpdatedStudent_Id'>");
   echo "</form>";
//form to post from textbox input to update Equip_id
   echo ("<td> $row->Equip_id");
   echo ("<form action=Signed_Equip.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hIdden' name ='UpdateD' value = $row->ID>");  
   echo ("Change Equip_id <input type=text name='UpdatedEquip_id'>");
   echo "</form>";
//form to create the delete button to remove a row from the database and crud
   echo ("<form action=Signed_Equip.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hIdden' name ='remove' value = $row->ID>");
   echo "</form>";
}
//end of php
?>

</table>
<P>
<hr>
<P>

<form action=Signed_Equip.php method=post>
<pre>
<!-- Textboxes to input a new record -->
       New Signed_Equip:
	Student_Id <input type=text name="Student_Id">
	Equip_id <input type=text name="Equip_id">
       <input type=submit value="Add Record">
<a href ="Administrator.php"> Back to Administrative Activities </a>
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
