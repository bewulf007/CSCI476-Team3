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
<td bgcolor=green>Email
<td bgcolor=yellow>Update Email
<td bgcolor=green>Phone
<td bgcolor=yellow>Update Phone
<td bgcolor=green>Building
<td bgcolor=yellow>Update Building
<td bgcolor=green>Office
<td bgcolor=yellow>Update Office
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
   $Email= mysqli_real_escape_string($DBconn, trim($_POST['Email']));
   $Phone= mysqli_real_escape_string($DBconn, trim($_POST['Phone']));
   $Building= mysqli_real_escape_string($DBconn, trim($_POST['Building']));
   $Office= mysqli_real_escape_string($DBconn, trim($_POST['Office']));
   $query = "INSERT INTO Instructor VALUES (NULL,'$Fname','$Lname','$Email','$Phone','$Building','$Office')";
   $result = mysqli_query ($DBconn, $query);
  }
//if post remove is set delete the row with the id == remove
elseif (isset($_POST['remove']))
{
//trim input to prevent sql injections
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Instructor WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query);
}
//change Fname of Instructor if update was clicked and if post is not empty
elseif (isset($_POST['UpdateFN']))
{
	if(!empty($_POST['UpdatedFname']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateFN']));
	$UpdateFname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedFname']));
	$query = "UPDATE Instructor SET Fname = \"$UpdateFname\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedFname']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Fname');
}
}
//change Lname of Instructor if update was clicked and if post is not empty
elseif (isset($_POST['UpdateLN']))
{
	if(!empty($_POST['UpdatedLname']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateLN']));
	$UpdateLname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedLname']));
	$query = "UPDATE Instructor SET Lname = \"$UpdateLname\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedLname']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Lname');
}
}
//change Email of Instructor if update was clicked and if post is not empty
elseif (isset($_POST['UpdateE']))
{
	if(!empty($_POST['UpdatedEmail']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateE']));
	$UpdateEmail= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedEmail']));
	$query = "UPDATE Instructor SET Email = \"$UpdateEmail\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedEmail']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Email');
}
}
//change Phone of Instructor if update was clicked and if post is not empty
elseif (isset($_POST['UpdateP']))
{
	if(!empty($_POST['UpdatedPhone']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateP']));
	$UpdatePhone = mysqli_real_escape_string($DBconn, trim($_POST['UpdatedPhone']));
	$query = "UPDATE Instructor SET Phone = \"$UpdatePhone\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedPhone']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Phone');
}
}
//change Building of Instructor if update was clicked and if post is not empty
elseif (isset($_POST['UpdateB']))
{
	if(!empty($_POST['UpdatedBuilding']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateB']));
	$UpdateBuilding= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedBuilding']));
	$query = "UPDATE Instructor SET Building = \"$UpdateBuilding\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedBuilding']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Building');
}
}
//change Office of Instructor if update was clicked and if post is not empty
elseif (isset($_POST['UpdateO']))
{
	if(!empty($_POST['UpdatedOffice']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateO']));
	$UpdateOffice= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedOffice']));
	$query = "UPDATE Instructor SET Office = \"$UpdateOffice\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedOffice']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Office');
}
}
// submit and process the query for exisiting Instructors
$query = "select * from Instructor;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Fname");
//form to post from textbox input to update Fname
   echo ("<form action=Instructor.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateFN' value = $row->id>");  
   echo ("Change Fname <input type=text name='UpdatedFname'>");
   echo "</form>";
//form to post from textbox input to update Lname
   echo("<td> $row->Lname");
   echo ("<form action=Instructor.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateLN' value = $row->id>");  
   echo ("Change Lname <input type=text name='UpdatedLname'>");
   echo "</form>";
//form to post from textbox input to update Email
   echo ("<td> $row->Email");
   echo ("<form action=Instructor.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateE' value = $row->id>");  
   echo ("Change Email <input type=text name='UpdatedEmail'>");
   echo "</form>";
//form to post from textbox input to update Phone
   echo ("<td> $row->Phone");
   echo ("<form action=Instructor.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateP' value = $row->id>");  
   echo ("Change Phone <input type=text name='UpdatedPhone'>");
   echo "</form>";
//form to post from textbox input to update Building
   echo ("<td> $row->Building");
   echo ("<form action=Instructor.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateB' value = $row->id>");  
   echo ("Change Building <input type=text name='UpdatedBuilding'>");
   echo "</form>";
//form to post from textbox input to update Office
   echo ("<td> $row->Office");
   echo ("<form action=Instructor.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateO' value = $row->id>");  
   echo ("Change Office <input type=text name='UpdatedOffice'>");
   echo "</form>";
//form to create the delete button to remove a row from the database and crud
   echo ("<form action=Instructor.php method =post>");
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

<form action=Instructor.php method=post>
<pre>
<!-- Textboxes to input a new record -->
		New Instructor Info:
		Fname <input type=text name="Fname">
		Lname <input type=text name="Lname">
		Email <input type=text name="Email">
		Phone <input type=text name="Phone">
		Building <input type=text name="Building">
		Office <input type=text name="Office">
       <input type=submit value="Add Record">
<a href ="Administrator.html"> Back to Administrator Page </a>
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
