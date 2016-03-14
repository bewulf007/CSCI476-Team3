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
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysql_error());
// if the form has data, then insert a new record
if (isset($_POST['Name']))
  {
   $Name= $_POST['Name'];
   $MaxNum= $_POST['MaxNum'];
   $instructor_id = $_POST['instructor_id'];
   $query = "INSERT INTO Camp VALUES (NULL,'$Name','$MaxNum','$instructor_id')";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Camp WHERE id = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}
//change Name of Camp if update was clicked and if post is not empty
elseif (isset($_POST['UpdateName']))
{
	if(!empty($_POST['UpdatedName']))
{
	$update = $_POST['UpdateName'];
	$UpdateName= $_POST['UpdatedName'];
	$query = "UPDATE Camp SET Name = \"$UpdateName\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedName']))
{
	throw new InvalidArgumentException('Invalid Name');
}
}
//change MaxNum of Camp if update was clicked and if post is not empty
elseif (isset($_POST['UpdateMaxNum']))
{
	if(!empty($_POST['UpdatedMaxNum']))
{
	$update = $_POST['UpdateMaxNum'];
	$UpdateMaxNum= $_POST['UpdatedMaxNum'];
	$query = "UPDATE Camp SET MaxNum = \"$UpdateMaxNum\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedMaxNum']))
{
	throw new InvalidArgumentException('Invalid MaxNum');
}
}
//change title of duration if update was clicked and if post is not empty
elseif (isset($_POST['UpdateInstructor_id']))
{
	if(!empty($_POST['UpdatedInstructor_id']))
{
	$update = $_POST['UpdateInstructor_id'];
	$UpdateInstructor_id= $_POST['UpdatedInstructor_id'];
	$query = "UPDATE Camp SET instructor_id = \"$UpdateInstructor_id\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedInstructor_id']))
{
	throw new InvalidArgumentException('Invalid instructor_id');
}
}

// submit and process the query for existing Artists
$query = "select * from Camp;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Name");
   echo ("<form action=Camp.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateName' value = $row->id>");  
   echo ("Change Name <input type=text name='UpdatedName'>");
   echo "</form>";
   echo("<td> $row->MaxNum");
   echo ("<form action=Camp.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateMaxNum' value = $row->id>");  
   echo ("Change MaxNum <input type=text name='UpdatedMaxNum'>");
   echo "</form>";
   echo ("<td> $row->instructor_id");
   echo ("<form action=Camp.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='Updateinstructor_id' value = $row->id>");  
   echo ("Change instructor_id <input type=text name='Updatedinstructor_id'>");
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
	      instructor_id <input type=text name="instructor_id">
       <input type=submit value="Add Camp Info">
<a href ="JoinedTable.php"> Camp Contact Table </a>
</pre>
</form>
<P>
<hr>
</html>
