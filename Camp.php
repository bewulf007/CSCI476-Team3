<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Allows Budgets to be Added to the Budgets Table -->
<html>
<hr>
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



<?php
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
if (!$db_selected)
   die ("Can't use my_morriss11 : " . mysqli_error());

// if the form has data, then insert a new record
if (isset($_POST['Name']))
  {
   $Name= mysqli_real_escape_string($DBconn, trim($_POST['Name']));
   $MaxNum= mysqli_real_escape_string($DBconn, trim($_POST['MaxNum']));
   $Instructor_id = mysqli_real_escape_string($DBconn, trim($_POST['Instructor_id']));
   $query = "INSERT INTO Camp VALUES (NULL,'$Name','$MaxNum','$Instructor_id')";
   $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
  }
elseif (isset($_POST['remove']))
{
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Camp WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
//change Name of Camp if update was clicked and if post is not empty
elseif (isset($_POST['UpdateN']))
{
	if(!empty($_POST['UpdatedName']))
{
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
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Name");
   echo ("<form action=Camp.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateN' value = $row->id>");  
   echo ("Change Name <input type=text name='UpdatedName'>");
   echo "</form>";
   echo("<td> $row->MaxNum");
   echo ("<form action=Camp.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateMN' value = $row->id>");  
   echo ("Change MaxNum <input type=text name='UpdatedMaxNum'>");
   echo "</form>";
   echo ("<td> $row->Instructor_id");
   echo ("<form action=Camp.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateI' value = $row->id>");  
   echo ("Change Instructor_id <input type=text name='UpdatedInstructor_id'>");
   echo "</form>";
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
