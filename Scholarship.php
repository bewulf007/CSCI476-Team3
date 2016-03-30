<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Scholarship
<tr>
<td bgcolor=green>Id
<td bgcolor=green>Student_id
<td bgcolor=yellow>Update Student_id
<td bgcolor=green>Camp_id
<td bgcolor=yellow>Update Camp_id
<td bgcolor=green>Essay
<td bgcolor=yellow>Update Essay
<td bgcolor=red>Delete

<?php
// connect the database
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysql_error());
   
   //If the form has data, then insert a new record
   if (isset($_POST['Student_id']))
  {
   $Student_id= $_POST['Student_id'];
   $Camp_id = $_POST['Camp_id'];
   $Essay= $_POST['Essay'];
   $query = "INSERT INTO Scholarship VALUES (NULL,'$Student_id','$Camp_id','$Essay')";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Scholarship WHERE id = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}

//change Student_id of Scholarship if update was clicked and if post is not empty
elseif (isset($_POST['UpdateSID']))
{
	if(!empty($_POST['UpdatedStudent_id']))
{
	$update = $_POST['UpdateSID'];
	$UpdateStudent_id= $_POST['UpdatedStudent_id'];
	$query = "UPDATE Scholarship SET Student_id = \"$UpdateStudent_id\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedStudent_id']))
{
	throw new InvalidArgumentException('Invalid Student_id');
}
}

//change Camp_id of Scholarship if update was clicked and if post is not empty
elseif (isset($_POST['UpdateCID']))
{
	if(!empty($_POST['UpdatedCamp_id']))
{
	$update = $_POST['UpdateCID'];
	$UpdateCamp_id= $_POST['UpdatedCamp_id'];
	$query = "UPDATE Scholarship SET Camp_id = \"$UpdateCamp_id\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedCamp_id']))
{
	throw new InvalidArgumentException('Invalid Camp_id');
}
}

//change Essay of Scholarship if update was clicked and if post is not empty
elseif (isset($_POST['UpdateE']))
{
	if(!empty($_POST['UpdatedEssay']))
{
	$update = $_POST['UpdateE'];
	$UpdateEssay= $_POST['UpdatedEssay'];
	$query = "UPDATE Scholarship SET Essay = \"$UpdateEssay\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedEssay']))
{
	throw new InvalidArgumentException('Invalid Essay');
}
}

// submit and process the query for exisiting Scholarships
$query = "select * from Scholarship;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Student_id");
   echo ("<form action=Scholarship.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateSID' value = $row->id>");  
   echo ("Change Student_id <input type=text name='UpdatedStudent_id'>");
   echo "</form>";
   echo("<td> $row->Camp_id");
   echo ("<form action=Scholarship.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateCID' value = $row->id>");  
   echo ("Change Camp_id <input type=text name='UpdatedCamp_id'>");
   echo "</form>";
   echo ("<td> $row->Essay");
   echo ("<form action=Scholarship.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateE' value = $row->id>");  
   echo ("Change Essay <input type=text name='UpdatedEssay'>");
   echo "</form>";
   echo ("<form action=Scholarship.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=Scholarship.php method=post>
<pre>
		New Scholarship Info:
		Student_id <input type=text name="Student_id">
		Camp_id <input type=text name="Camp_id">
		Essay <input type=text name="Essay">
       <input type=submit value="Add Record">
<a href ="JoinedTable.php"> Addresses And Zips Table </a>
</pre>
</form>
<P>
<hr>
</html>
