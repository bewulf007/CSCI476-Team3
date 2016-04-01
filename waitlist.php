<!-- Matthew Paterno -->
<!-- Database Program -->
<!-- Allows Records to be Added to the Waitlist Table -->
<!-- Contains one form that is also processed by this script -->

<html>
<hr>
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



<?php
// connect the database
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysql_error());

// if the form had data, then insert a new record
if (isset($_POST['Student_id']))
  {

   $Student_id = $_POST['Student_id'];
   $Camp_id= $_POST['Camp_id'];
   $query = "INSERT INTO Waitlist VALUES ($Student_id,$Camp_id)";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Waitlist Student_id WHERE  = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}
//change Student_id of song if update was clicked and if post is not empty
elseif (isset($_POST['UpdateT']))
{
	if(!empty($_POST['UpdatedStudent_id']))
{
	$update = $_POST['UpdateT'];
	$UpdateStudent_id= $_POST['UpdatedStudent_id'];
	$query = "UPDATE Waitlist SET Student_id = \"$UpdateStudent_id\" WHERE Student_id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedStudent_id']))
{
	throw new InvalidArgumentException('Invalid Student_id');
}

}
//change Student_id of Camp_id if update was clicked and if post is not empty
elseif (isset($_POST['UpdateD']))
{
	if(!empty($_POST['UpdatedCamp_id']))
{
	$update = $_POST['UpdateD'];
	$UpdateCamp_id= $_POST['UpdatedCamp_id'];
	$query = "UPDATE Waitlist SET Camp_id = $UpdateCamp_id WHERE Student_id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedCamp_id']))
{
	throw new InvalidArgumentException('Invalid Camp_id');
}

}

/*elseif (isset($_POST['move']
{
	$move = $_POST['move'];
        $query = "Insert INTO Campers
	$query = "DELETE FROM Waitlist Student_id WHERE  = \"$move\"";
	$result = mysql_query ($query, $DBconn);
}*/
// submit and process the query for existing Students
$query = "Select Waitlist.id, Student_id, Fname, Lname, Waitlist.Camp_id
 from Student JOIN Waitlist 
WHERE Student.id=Waitlist.Student_id
ORDER BY Student_id ASC;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   echo ("<tr> <td> $row->Student_id");
   echo("<td> $row->Student_id");
   echo ("<form action=waitlist.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateT' value = $row->Student_id>");  
   echo ("Change Student_id <input type=text name='UpdatedStudent_id'>");
   echo "</form>";
   echo("<td> $row->Fname");
   echo("<td> $row->Lname");
   echo ("<td> $row->Camp_id");
   echo ("<form action=waitlist.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateD' value = $row->Student_id>");  
   echo ("Change Camp_id <input type=text name='UpdatedCamp_id'>");
   echo "</form>";
   echo ("<form action=waitlist.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->Student_id>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=waitlist.php method=post>
<pre>
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
