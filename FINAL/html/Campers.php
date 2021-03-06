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
<!-- Allows Campers to be Added to the Campers Table -->
<html>
<hr>
<P>

<form action=Campers.php method=post>
<pre>
<!-- Textboxes to input a new record -->
        New Campers:
        Student_Id <input type=text name="Student_Id">
        Camp_Id    <input type=text name="Camp_Id">
       <input type=submit value="Add Record">

<!-- output table for crud -->
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Campers
<tr>
<td bgcolor=green>Id
<td bgcolor=green>Student_Id
<td bgcolor=yellow>Update Student_Id
<td bgcolor=green>First Name
<td bgcolor=green>Last Name
<td bgcolor=green>Camp_Id
<td bgcolor=yellow>Update Camp_Id
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
   $Camp_Id= mysqli_real_escape_string($DBconn, trim($_POST['Camp_Id']));
   $query = "INSERT INTO Campers VALUES (Null,$Student_Id,$Camp_Id)";
   $result = mysqli_query ($DBconn, $query);
  }
elseif (isset($_POST['remove']))
{
//trim input to prevent sql injections
//if remove is set then delete the row with the correlated ID posted from hitting the delete button
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Campers WHERE ID = \"$remove\"";
	$result = mysqli_query ($DBconn, $query);
}
//change Student_Id of song if update was clicked and if post is not empty
elseif (isset($_POST['UpdateT']))
{
	if(!empty($_POST['UpdatedStudent_Id']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateT']));
	$UpdateStudent_Id= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedStudent_Id']));
	$query = "UPDATE Campers SET Student_Id = \"$UpdateStudent_Id\" WHERE ID = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedStudent_Id']))
{
//exception if the post is empty output error message
	throw new InvalIdArgumentException('InvalId Student_Id');
}
}
//change Student_Id of Camp_Id if update was clicked and if post is not empty
elseif (isset($_POST['UpdateD']))
{
	if(!empty($_POST['UpdatedCamp_Id']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateD']));
	$UpdateCamp_Id= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedCamp_Id']));
	$query = "UPDATE Campers SET Camp_Id = $UpdateCamp_Id WHERE ID = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedCamp_Id']))
{
	throw new InvalIdArgumentException('InvalId Camp_Id');
}
}
// submit and process the query for existing Students
$query = "Select Campers.ID, Student_Id, Fname, Lname, Camp_Id
 from Student JOIN Campers 
WHERE Student.id=Campers.Student_id
ORDER BY Student_Id ASC;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->ID");
   echo("<td> $row->Student_Id");
//form to post from textbox input to update camperid
   echo ("<form action=Campers.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hIdden' name ='UpdateT' value = $row->ID>");  
   echo ("Change Student_Id <input type=text name='UpdatedStudent_Id'>");
   echo "</form>";
   echo("<td> $row->Fname");
   echo("<td> $row->Lname");
   echo ("<td> $row->Camp_Id");
   echo ("<form action=Campers.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hIdden' name ='UpdateD' value = $row->ID>");  
   echo ("Change Camp_Id <input type=text name='UpdatedCamp_Id'>");
   echo "</form>";
//form to create the delete button to remove a row from the database and crud
   echo ("<form action=Campers.php method =post>");
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

<form action=Campers.php method=post>
<pre>
<!-- Textboxes to input a new record -->
        New Campers:
	Student_Id <input type=text name="Student_Id">
	Camp_Id    <input type=text name="Camp_Id">
       <input type=submit value="Add Record">
<!-- links to other adminstrative pages -->
<P>
	<a href ="Student.php">Student Table </a> - To Reference Student Id's
<P>
	<a href ="Camp.php">Camp Table </a> - To Reference Camp Id's
<P>
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
