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
<!-- Database Program -->
<!-- Allows Records to be Added to the Waitlist Table -->
<!-- Dispalys students on the waitist -->

<html>
<hr>
<!--table for output -->
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Current Wait List
<tr>
<td bgcolor=green>Id
<td bgcolor=green>Student_id
<td bgcolor=yellow>Update Student_id
<td bgcolor=green>First Name
<td bgcolor=green>Last Name
<td bgcolor=green>Camp_id
<td bgcolor=yellow>Update Camp_id
<td bgcolor=red>Delete

<!--end of table -->

<?php //php begins here
require_once ('connection.php');

// if the form had data, then insert a new record
if (isset($_POST['Student_id']))
  {
//trim input to prevent sql injections
   $Student_id = mysqli_real_escape_string($DBconn, trim($_POST['Student_id']));
   $Camp_id= mysqli_real_escape_string($DBconn, trim($_POST['Camp_id']));
   $query = "INSERT INTO Waitlist VALUES ($Student_id,$Camp_id)";
   $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
  }
//if post remove is set delete the row with the id == remove
elseif (isset($_POST['remove']))
{
//trim input to prevent sql injections
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Waitlist Student_id WHERE  = \"$remove\"";
	$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
//change Student_id of song if update was clicked and if post is not empty
elseif (isset($_POST['UpdateT']))
{
	if(!empty($_POST['UpdatedStudent_id']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateT']));
	$UpdateStudent_id= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedStudent_id']));
	$query = "UPDATE Waitlist SET Student_id = \"$UpdateStudent_id\" WHERE Student_id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedStudent_id']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Student_id');
}

}
//change Student_id of Camp_id if update was clicked and if post is not empty
elseif (isset($_POST['UpdateD']))
{
	if(!empty($_POST['UpdatedCamp_id']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateD']));
	$UpdateCamp_id= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedCamp_id']));
	$query = "UPDATE Waitlist SET Camp_id = $UpdateCamp_id WHERE Student_id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedCamp_id']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Camp_id');
}

}

// submit and process the query for existing Students
$query = "Select Waitlist.id, Student_id, Fname, Lname, Waitlist.Camp_id
 from Student JOIN Waitlist 
WHERE Student.id=Waitlist.Student_id
ORDER BY Student_id ASC;";
$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
while ($row = mysqli_fetch_object ($result))
{
//generate table with data from database
   echo ("<tr> <td> $row->Student_id");
   echo("<td> $row->Student_id");
//form to post from textbox input to update Student_ID
   echo ("<form action=waitlist.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateT' value = $row->Student_id>");  
   echo ("Change Student_id <input type=text name='UpdatedStudent_id'>");
   echo "</form>";
   echo("<td> $row->Fname");
   echo("<td> $row->Lname");
   echo ("<td> $row->Camp_id");
//form to post from textbox input to update Camp_id
   echo ("<form action=waitlist.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateD' value = $row->Student_id>");  
   echo ("Change Camp_id <input type=text name='UpdatedCamp_id'>");
   echo "</form>";
//form to create the delete button to remove a row from the database and crud
   echo ("<form action=waitlist.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->Student_id>");
   echo "</form>";
}
//end of php
?>

</table>
<P>
<hr>
<P>

<form action=waitlist.php method=post>
<pre>
<!-- Textboxes to input a new record -->
        New Waitlist:
	Student_id <input type=text name="Student_id">
	Camp_id    <input type=text name="Camp_id">
       <input type=submit value="Add Record">
<P>
	<a href ="Student.php">Student Table </a> - To Reference Student Id's
<P>
	<a href ="Camp.php">Camp Table </a> - To Reference Camp Id's
<P>
	<a href ="Administrator.html">Back To Administration </a>
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
