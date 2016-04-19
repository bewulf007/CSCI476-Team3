<html>
<hr>
<!--table for output -->
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=12 align=center><font color=white>Scholarship
<tr>
<td bgcolor=green>Id
<td bgcolor=green>Student First Name
<td bgcolor=yellow>Update Student First Name
<td bgcolor=green>Student Last Name
<td bgcolor=yellow>Update Student Last Name
<td bgcolor=green>Parent First Name
<td bgcolor=yellow>Update Parent First Name
<td bgcolor=green>Parent Last Name
<td bgcolor=yellow>Update Parent Last Name
<td bgcolor=green>Essay
<td bgcolor=yellow>Update Essay
<td bgcolor=red>Delete

<!--end of table -->

<?php //php begins here
// connect the database
require_once ('connection.php');
   
   //If the form has data, then insert a new record
   if (isset($_POST['SFname']))
  {
//trim input to prevent sql injections
   $SFname= mysqli_real_escape_string($DBconn, trim($_POST['SFname']));
   $SLname = mysqli_real_escape_string($DBconn, trim($_POST['SLname']));
   $PFname = mysqli_real_escape_string($DBconn, trim($_POST['PFname']));
   $PLname = mysqli_real_escape_string($DBconn, trim($_POST['PLname']));
   $Essay= mysqli_real_escape_string($DBconn, trim($_POST['Essay']));
   $query = "INSERT INTO Scholarship VALUES (NULL,'$SFname','$SLname','$PFname','$PLname','$Essay')";
   $result = mysqli_query ($DBconn, $query);
  }
//if post remove is set delete the row with the id == remove
elseif (isset($_POST['remove']))
{
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Scholarship WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query);
}
//change Student_id of Scholarship if update was clicked and if post is not empty
elseif (isset($_POST['UpdateSFname']))
{
	if(!empty($_POST['UpdatedSFname']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateSFname']));
	$UpdateSFname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedSFname']));
	$query = "UPDATE Scholarship SET SFname = \"$UpdateSFname\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedSFname']))
{
	throw new InvalidArgumentException('Invalid SFname');
}
}
//change Camp_id of Scholarship if update was clicked and if post is not empty
elseif (isset($_POST['UpdateSLname']))
{
	if(!empty($_POST['UpdatedSLname']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateSLname']));
	$UpdateSLname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedSLname']));
	$query = "UPDATE Scholarship SET SLname = \"$UpdateSLname\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedSLname']))
{
	throw new InvalidArgumentException('Invalid SLname');
}
}
elseif (isset($_POST['UpdatePFname']))
{
	if(!empty($_POST['UpdatedPFname']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdatePFname']));
	$UpdatePFname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedPFname']));
	$query = "UPDATE Scholarship SET PFname = \"$UpdatePFname\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedPFname']))
{
	throw new InvalidArgumentException('Invalid PFname');
}
}
//change Camp_id of Scholarship if update was clicked and if post is not empty
elseif (isset($_POST['UpdatePLname']))
{
	if(!empty($_POST['UpdatedPLname']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdatePLname']));
	$UpdatePLname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedPLname']));
	$query = "UPDATE Scholarship SET PLname = \"$UpdatePLname\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedPLname']))
{
	throw new InvalidArgumentException('Invalid PLname');
}
}
//change Essay of Scholarship if update was clicked and if post is not empty
elseif (isset($_POST['UpdateE']))
{
	if(!empty($_POST['UpdatedEssay']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateE']));
	$UpdateEssay= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedEssay']));
	$query = "UPDATE Scholarship SET Essay = \"$UpdateEssay\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedEssay']))
{
	throw new InvalidArgumentException('Invalid Essay');
}
}
// submit and process the query for exisiting Scholarships
$query = "select * from Scholarship;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
//form to post from textbox input to update SFname
   echo("<td> $row->SFname");
   echo ("<form action=Scholarship.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateSFname' value = $row->id>");  
   echo ("Change SFname <input type=text name='UpdatedSFname'>");
   echo "</form>";
//form to post from textbox input to update SLname
   echo("<td> $row->SLname");
   echo ("<form action=Scholarship.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateSLname' value = $row->id>");  
   echo ("Change Student Last Name <input type=text name='UpdatedSLname'>");
   echo "</form>";
//form to post from textbox input to update PFname
   echo("<td> $row->PFname");
   echo ("<form action=Scholarship.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdatePFname' value = $row->id>");  
   echo ("Change Parent First Name <input type=text name='UpdatedPFname'>");
   echo "</form>";
//form to post from textbox input to update PLname
   echo("<td> $row->PLname");
   echo ("<form action=Scholarship.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdatePLname' value = $row->id>");  
   echo ("Change Parent Last Name <input type=text name='UpdatedPLname'>");
   echo "</form>";
//form to post from textbox input to update Essay
   echo ("<td> $row->Essay");
   echo ("<form action=Scholarship.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateE' value = $row->id>");  
   echo ("Change Essay <input type=text name='UpdatedEssay'>");
   echo "</form>";
//form to create the delete button to remove a row from the database and crud
   echo ("<form action=Scholarship.php method =post>");
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

<form action=Scholarship.php method=post>
<pre>
<!-- Textboxes to input a new record -->
	New Scholarship Info:
	SFname <input type=text name="SFname">
	SLname <input type=text name="SLname">
        PFname <input type=text name="PFname">
	PLname <input type=text name="PLname">
	Essay  <input type=text name="Essay">
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
