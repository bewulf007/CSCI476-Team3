<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Allows Campers to be Added to the Campers Table -->
<html>
<hr>
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



<?php
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysqli_error());

// if the form had data, then insert a new record
if (isset($_POST['Student_Id']))
  {
   $Student_Id = mysqli_real_escape_string($DBconn, trim($_POST['Student_Id']));
   $Camp_Id= mysqli_real_escape_string($DBconn, trim($_POST['Camp_Id']));
   $query = "INSERT INTO Campers VALUES (Null,$Student_Id,$Camp_Id)";
   $result = mysqli_query ($DBconn, $query);
  }
elseif (isset($_POST['remove']))
{
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Campers WHERE ID = \"$remove\"";
	$result = mysqli_query ($DBconn, $query);
}
//change Student_Id of song if update was clicked and if post is not empty
elseif (isset($_POST['UpdateT']))
{
	if(!empty($_POST['UpdatedStudent_Id']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateT']));
	$UpdateStudent_Id= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedStudent_Id']));
	$query = "UPDATE Campers SET Student_Id = \"$UpdateStudent_Id\" WHERE ID = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedStudent_Id']))
{
	throw new InvalIdArgumentException('InvalId Student_Id');
}
}
//change Student_Id of Camp_Id if update was clicked and if post is not empty
elseif (isset($_POST['UpdateD']))
{
	if(!empty($_POST['UpdatedCamp_Id']))
{
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
$result = mysqli_query ($query, $DBconn);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->ID");
   echo("<td> $row->Student_Id");
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
   echo ("<form action=Campers.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hIdden' name ='remove' value = $row->ID>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=Campers.php method=post>
<pre>
        New Campers:
	Student_Id <input type=text name="Student_Id">
	Camp_Id    <input type=text name="Camp_Id">
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
