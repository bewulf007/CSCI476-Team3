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
<!-- Allows Budgets to be Added to the Budgets Table -->
<html>
<hr>
<!--create table for crud to be displayed -->
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>id
<td bgcolor=green>Name
<td bgcolor=yellow>Update Name
<td bgcolor=green>MaxNum
<td bgcolor=yellow>Update MaxNum
<td bgcolor=green>Instructor
<td bgcolor=yellow>Update Instructor
<td bgcolor=red>Delete

<!--end of table code -->

<?php
// connect the database
require_once ('connection.php');

// if the form has data, then insert a new record
if (isset($_POST['Name']))
  {
//trim all input to prevent SQL injections
   $Name= mysqli_real_escape_string($DBconn, trim($_POST['Name']));
   $MaxNum= mysqli_real_escape_string($DBconn, trim($_POST['MaxNum']));
   $Instructor_id = mysqli_real_escape_string($DBconn, trim($_POST['Instructor_id']));
   $query = "INSERT INTO Camp VALUES (NULL,'$Name','$MaxNum','$Instructor_id')";
   $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
  }

elseif (isset($_POST['remove']))
{
//trim all input to prevent SQL injections
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Camp WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
//change Name of Camp if update was clicked and if post is not empty
elseif (isset($_POST['UpdateN']))
{
	if(!empty($_POST['UpdatedName']))
{
//trim all input to prevent SQL injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateN']));
	$UpdateName= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedName']));
	$query = "UPDATE Camp SET Name = \"$UpdateName\" WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedName']))
{
	throw new InvalidArgumentException('Invalid Name');
}
}
//change MaxNum of Camp if update was clicked and if post is not empty
elseif (isset($_POST['UpdateMN']))
{
	if(!empty($_POST['UpdatedMaxNum']))
{
//trim all input to prevent SQL injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateMN']));
	$UpdateMaxNum= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedMaxNum']));
	$query = "UPDATE Camp SET MaxNum = \"$UpdateMaxNum\" WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedMaxNum']))
{
	throw new InvalidArgumentException('Invalid MaxNum');
}
}
//change Instructor of Camp if update was clicked and if post is not empty
elseif (isset($_POST['UpdateI']))
{
	if(!empty($_POST['UpdatedInstructor_id']))
{
//trim all input to prevent SQL injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateI']));
	$UpdateInstructor_id= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedInstructor_id']));
	$query = "UPDATE Camp SET Instructor_id = \"$UpdateInstructor_id\" WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedInstructor_id']))
{
	throw new InvalidArgumentException('Invalid Instructor_id');
}
}
// submit and process the query for existing Instructors
$query = "select * from Camp;";
$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
while ($row = mysqli_fetch_object ($result))
{
//output the ID
   echo ("<tr> <td> $row->id");
//output the name
   echo("<td> $row->Name");
//form to post from textbox input to update Name
   echo ("<form action=Camp.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateN' value = $row->id>");  
   echo ("Change Name <input type=text name='UpdatedName'>");
   echo "</form>";
   echo("<td> $row->MaxNum");
//form to post from textbox input to update Maxnum
   echo ("<form action=Camp.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateMN' value = $row->id>");  
   echo ("Change MaxNum <input type=text name='UpdatedMaxNum'>");
   echo "</form>";
//form to post from textbox input to update Instructor_ID
   echo ("<td> $row->Instructor_id");
   echo ("<form action=Camp.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateI' value = $row->id>");  
   echo ("Change Instructor_id <input type=text name='UpdatedInstructor_id'>");
   echo "</form>";
//form to post remove by clicking the delete button this will remove this row from the database and thhe crud
   echo ("<form action=Camp.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=Camp.php method=post>
<pre>
<!-- Textboxes to input a new record -->
       New Camp Info:
       Name <input type=text name="Name">
	   MaxNum <input type=text name="MaxNum">
	   Instructor_id <input type=text name="Instructor_id">
       <input type=submit value="Add Camp Info">
<a href ="Administrator.html"> Back To Administration </a>
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
