<!-- Matthew Paterno -->
<!-- Database Program -->
<!-- Allows Records to be Added to the Waitlist Table -->
<!-- Contains one form that is also processed by this script -->

<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>student_id
<td bgcolor=green>student_id
<td bgcolor=yellow>Update student_id
<td bgcolor=green>camp_id
<td bgcolor=yellow>Update camp_id
<td bgcolor=red>Delete



<?php
// connect the database
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysql_error());

// if the form had data, then insert a new record
if (isset($_POST['student_id']))
  {

   $student_id = $_POST['student_id'];
   $camp_id= $_POST['camp_id'];
   $query = "INSERT INTO Waitlist VALUES ('$student_id',$camp_id)";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Waitlist student_id WHERE  = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}
//change student_id of song if update was clicked and if post is not empty
elseif (isset($_POST['UpdateT']))
{
	if(!empty($_POST['Updatedstudent_id']))
{
	$update = $_POST['UpdateT'];
	$Updatestudent_id= $_POST['Updatedstudent_id'];
	$query = "UPDATE Waitlist SET student_id = \"$Updatestudent_id\" WHERE student_id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['Updatedstudent_id']))
{
	throw new InvalidArgumentException('Invalid student_id');
}

}
//change student_id of camp_id if update was clicked and if post is not empty
elseif (isset($_POST['UpdateD']))
{
	if(!empty($_POST['Updatedcamp_id']))
{
	$update = $_POST['UpdateD'];
	$Updatecamp_id= $_POST['Updatedcamp_id'];
	$query = "UPDATE Waitlist SET camp_id = $Updatecamp_id WHERE student_id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['Updatedcamp_id']))
{
	throw new InvalidArgumentException('Invalid camp_id');
}

}

// submit and process the query for existing Students
$query = "select * from Waitlist;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   echo("<td> $row->student_id");
   echo ("<form action=waitlist.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateT' value = $row->student_id>");  
   echo ("Change student_id <input type=text name='Updatedstudent_id'>");
   echo "</form>";
   echo ("<td> $row->camp_id");
   echo ("<form action=waitlist.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateD' value = $row->student_id>");  
   echo ("Change camp_id <input type=text name='Updatedcamp_id'>");
   echo "</form>";
   echo ("<form action=waitlist.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->student_id>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=waitlist.php method=post>
<pre>
       New Song Info:
	student_id <input type=text name="student_id">
	camp_id <input type=text name="camp_id">
       <input type=submit value="Add Record">
<a href ="JoinedTable.php"> Songs And Artists Table </a>
</pre>
</form>
<P>
<hr>
</html>
