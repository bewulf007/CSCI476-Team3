<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Equipment
<tr>
<td bgcolor=green>Name
<td bgcolor=yellow>Update Name
<td bgcolor=green>Student_id
<td bgcolor=yellow>Update Student_id
<td bgcolor=red>Delete

<?php
// connect the database
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysql_error());
   
   //If the form has data, then insert a new record
   if (isset($_POST['Name']))
  {
   $Name= $_POST['Name'];
   $Student_id = $_POST['Student_id'];
   $query = "INSERT INTO Equipment VALUES (NULL,'$Name','$Student_id')";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Equipment WHERE id = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}
//change Name of Equipment if update was clicked and if post is not empty
elseif (isset($_POST['UpdateN']))
{
	if(!empty($_POST['UpdatedName']))
{
	$update = $_POST['UpdateN'];
	$UpdatedName= $_POST['UpdatedName'];
	$query = "UPDATE Equipment SET Name = \"$UpdateName\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedName']))
{
	throw new InvalidArgumentException('Invalid Name');
}
}
//change Student_id of Equipment if update was clicked and if post is not empty
elseif (isset($_POST['UpdateSID']))
{
	if(!empty($_POST['UpdatedStudent_id']))
{
	$update = $_POST['UpdateSID'];
	$UpdatedStudent_id= $_POST['UpdatedStudent_id'];
	$query = "UPDATE Equipment SET Student_id = \"$UpdateStudent_id\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedStudent_id']))
{
	throw new InvalidArgumentException('Invalid Student_id');
}
}

// submit and process the query for exisiting Equipments
$query = "select * from Equipment;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Name");
   echo ("<form action=crudtest.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateN' value = $row->id>");  
   echo ("Change Name <input type=text name='UpdatedName'>");
   echo "</form>";
   echo("<td> $row->Student_id");
   echo ("<form action=crudtest.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateSID' value = $row->id>");  
   echo ("Change Student_id <input type=text name='UpdatedStudent_id'>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=crudtest.php method=post>
<pre>
		New Equipment Info:
		Name <input type=text name="Name">
		Student_id <input type=text name="Student_id">
       <input type=submit value="Add Record">
<a href ="JoinedTable.php"> Addresses And Zips Table </a>
</pre>
</form>
<P>
<hr>
</html>
