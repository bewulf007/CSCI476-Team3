<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>id
<td bgcolor=green>First Name
<td bgcolor=yellow>Update First Name
<td bgcolor=green>Last Name
<td bgcolor=yellow>Update Last Name
<td bgcolor=green>Address Id
<td bgcolor=yellow>Update Address Id
<td bgcolor=green>Shirt Size
<td bgcolor=yellow>Update Shirt Size
<td bgcolor=green>School
<td bgcolor=yellow>Update School
<td bgcolor=green>Parent Id
<td bgcolor=yellow>Update Parent Id
<td bgcolor=green>Grade
<td bgcolor=yellow>Update Grade
<td bgcolor=green>Gender
<td bgcolor=yellow>Update Gender
<td bgcolor=green>Ethnicity
<td bgcolor=yellow>Update Ethnicity
<td bgcolor=green>Safe Pickup
<td bgcolor=yellow>Update Safe Pickup
<td bgcolor=green>No Pickup
<td bgcolor=yellow>Update No Pickup
<td bgcolor=green>Camp Id
<td bgcolor=yellow>Update Camp Id
<td bgcolor=green>Scholarship?
<td bgcolor=yellow>Update Scholarship
<td bgcolor=green>Emergency Id
<td bgcolor=yellow>Update Emergency Id
<td bgcolor=green>Accepted
<td bgcolor=yellow>Update Accepted
<td bgcolor=red>Delete



<?php
// connect the database
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysql_error());
// if the form has data, then insert a new record
if (isset($_POST['Fname']))
  {
   $Fname= $_POST['Fname'];
   $Lname = $_POST['Lname'];
   $Address_id= $_POST['Address_id'];
   $Shirt_Size= $_POST['Shirt_Size'];
   $School = $_POST['School'];
   $Parent_id = $_POST['Parent_id'];
   $Grade = $_POST['Grade'];
   $Gender = $_POST['Gender'];
   $Ethnicity = $_POST['Ethnicity'];
   $Safe_PU = $_POST['Safe_PU'];
   $No_PU = $_POST['Camp_id'];
   $Camp_id = $_POST['Camp_id'];
   $Scholarship = $_POST['Scholarship'];
   $Emerge_id = $_POST['Emerge_id'];
   $Accepted = $_POST['Accepted'];
   $query = "INSERT INTO Student VALUES (NULL,'$Fname','$Lname','$Address_id','$Shirt_Size','$School','$Parent_id','$Grade','$Gender',
   '$Ethnicity','$Safe_PU','$No_PU','$Camp_id','$Scholarship','$Emerge_id','$Accepted')";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Student WHERE id = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}

//change fname of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateF']))
{
	if(!empty($_POST['UpdatedFname']))
{
	$update = $_POST['UpdateF'];
	$UpdateFname= $_POST['UpdatedFname'];
	$query = "UPDATE Student SET Fname = \"$UpdateFname\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedFname']))
{
	throw new InvalidArgumentException('Invalid First name');
}
}

//change last name of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateL']))
{
	if(!empty($_POST['UpdatedLname']))
{
	$update = $_POST['UpdateL'];
	$UpdateLname= $_POST['UpdatedLname'];
	$query = "UPDATE Student SET Lname = \"$UpdateLname\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedLname']))
{
	throw new InvalidArgumentException('Invalid Last Name');
}
}

//change address id of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateA']))
{
	if(!empty($_POST['UpdatedAddress_id']))
{
	$update = $_POST['UpdateA'];
	$UpdateAddress_id= $_POST['UpdatedAddress_id'];
	$query = "UPDATE Student SET Address_id = \"$UpdateAddress_id\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedAddress_id']))
{
	throw new InvalidArgumentException('Invalid Address_id');
}
}

//change shirt size of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateS']))
{
	if(!empty($_POST['UpdatedShirt']))
{
	$update = $_POST['UpdateS'];
	$UpdateShirt = $_POST['UpdatedShirt'];
	$query = "UPDATE Student SET Shirt_Size = \"$UpdateShirt\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedShirt']))
{
	throw new InvalidArgumentException('Invalid Size');
}
}

//change school of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateSc']))
{
	if(!empty($_POST['UpdatedSchool']))
{
	$update = $_POST['UpdateSc'];
	$UpdateSchool = $_POST['UpdatedSchool'];
	$query = "UPDATE Student SET School = \"$UpdateSchool\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedSchool']))
{
	throw new InvalidArgumentException('Invalid School');
}
}

//change Parent_id of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateP']))
{
	if(!empty($_POST['UpdatedParent_id']))
{
	$update = $_POST['UpdateP'];
	$UpdateParent_id = $_POST['UpdatedParent_id'];
	$query = "UPDATE Student SET Parent_id = \"$UpdateParent_id\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedParent_id']))
{
	throw new InvalidArgumentException('Invalid Parent_id');
}
}

//change grade of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateG']))
{
	if(!empty($_POST['UpdatedGrade']))
{
	$update = $_POST['UpdateG'];
	$UpdateGrade = $_POST['UpdatedGrade'];
	$query = "UPDATE Student SET Grade = \"$UpdateGrade\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedGrade']))
{
	throw new InvalidArgumentException('Invalid Size');
}
}

//change gender of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateGe']))
{
	if(!empty($_POST['UpdatedGender']))
{
	$update = $_POST['UpdateGe'];
	$UpdateGender = $_POST['UpdatedGender'];
	$query = "UPDATE Student SET Gender = \"$UpdateGender\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedGender']))
{
	throw new InvalidArgumentException('Invalid Gender');
}
}

//change ethnicity of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateE']))
{
	if(!empty($_POST['UpdatedEthnicity']))
{
	$update = $_POST['UpdateE'];
	$UpdateEthnicity = $_POST['UpdatedEthnicity'];
	$query = "UPDATE Student SET Ethnicity = \"$UpdateEthnicity\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedEthnicity']))
{
	throw new InvalidArgumentException('Invalid Ethnicity');
}
}

//change safe pickup of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateSPU']))
{
	if(!empty($_POST['UpdatedSafe_PU']))
{
	$update = $_POST['UpdateSPU'];
	$UpdateSafe_PU = $_POST['UpdatedSafe_PU'];
	$query = "UPDATE Student SET Safe_PU = \"$UpdateSafe_PU\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedSafe_PU']))
{
	throw new InvalidArgumentException('Invalid Safe_PU');
}
}

//change No pick up of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateNPU']))
{
	if(!empty($_POST['UpdatedNo_PU']))
{
	$update = $_POST['UpdateNPU'];
	$UpdateNo_PU = $_POST['UpdatedNo_PU'];
	$query = "UPDATE Student SET No_PU = \"$UpdateNo_PU\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedNo_PU']))
{
	throw new InvalidArgumentException('Invalid No_PU');
}
}

//change Camp id of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateC']))
{
	if(!empty($_POST['UpdatedCamp_id']))
{
	$update = $_POST['UpdateC'];
	$UpdateCamp_id = $_POST['UpdatedCamp_id'];
	$query = "UPDATE Student SET Camp_id = \"$UpdateCamp_id\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedCamp_id']))
{
	throw new InvalidArgumentException('Invalid Camp_id');
}
}

//change scholarship of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateSchol']))
{
	if(!empty($_POST['UpdatedScholarship']))
{
	$update = $_POST['UpdateSchol'];
	$UpdateScholarship = $_POST['UpdatedScholarship'];
	$query = "UPDATE Student SET Scholarship = \"$UpdateScholarship\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedScholarship']))
{
	throw new InvalidArgumentException('Invalid Scholarship');
}
}

//change Emergency id of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateEm']))
{
	if(!empty($_POST['UpdatedEmerge_id']))
{
	$update = $_POST['UpdateEm'];
	$UpdateEmerge_id = $_POST['UpdatedEmerge_id'];
	$query = "UPDATE Student SET Emerge_id = \"$UpdateEmerge_id\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedEmerge_id']))
{
	throw new InvalidArgumentException('Invalid Emerge_id');
}
}

//change Accepted of student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateAc']))
{
	if(!empty($_POST['UpdatedAccepted']))
{
	$update = $_POST['UpdateAc'];
	$UpdateAccepted = $_POST['UpdatedAccepted'];
	$query = "UPDATE Student SET Accepted = \"$UpdateAccepted\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedAccepted']))
{
	throw new InvalidArgumentException('Invalid Accepted');
}
}

// submit and process the query for existing Students
$query = "select * from Student;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Fname");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateF' value = $row->id>");  
   echo ("Change Fname <input type=text name='UpdatedFname'>");
   echo "</form>";
   echo("<td> $row->Lname");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateL' value = $row->id>");  
   echo ("Change Lname <input type=text name='UpdatedLname'>");
   echo "</form>";
   echo ("<td> $row->Address_id");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateA' value = $row->id>");  
   echo ("Change Address_id <input type=text name='UpdatedAddress_id'>");
   echo "</form>";
   echo ("<td> $row->Shirt_Size");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateS' value = $row->id>");  
   echo ("Change Shirt_Size <input type=text name='UpdatedShirt'>");
   echo "</form>";
   echo ("<td> $row->School");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateSc' value = $row->id>");  
   echo ("Change School <input type=text name='UpdatedSchool'>");
   echo "</form>";
   echo ("<td> $row->Parent_id");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateP' value = $row->id>");  
   echo ("Change Parent_id <input type=text name='UpdatedParent_id'>");
   echo "</form>";
   echo ("<td> $row->Grade");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateG' value = $row->id>");  
   echo ("Change Grade <input type=text name='UpdatedGrade'>");
   echo "</form>";
   echo ("<td> $row->Gender");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateGe' value = $row->id>");  
   echo ("Change Gender <input type=text name='UpdatedGender'>");
   echo "</form>";
   echo ("<td> $row->Ethnicity");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateE' value = $row->id>");  
   echo ("Change Ethnicity <input type=text name='UpdatedEthnicity'>");
   echo "</form>";
   echo ("<td> $row->Safe_PU");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateSPU' value = $row->id>");  
   echo ("Change Safe_PU <input type=text name='UpdatedSafe_PU'>");
   echo "</form>";
   echo ("<td> $row->No_PU");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateNPU' value = $row->id>");  
   echo ("Change No_PU <input type=text name='UpdatedNo_PU'>");
   echo "</form>";
   echo ("<td> $row->Camp_id");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateC' value = $row->id>");  
   echo ("Change Camp_id <input type=text name='UpdatedCamp_id'>");
   echo "</form>";
   echo ("<td> $row->Scholarship");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateSchol' value = $row->id>");  
   echo ("Change Scholarship <input type=text name='UpdatedScholarship'>");
   echo "</form>";
   echo ("<td> $row->Emerge_id");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateEm' value = $row->id>");  
   echo ("Change Emerge_id <input type=text name='UpdatedEmerge_id'>");
   echo "</form>";
   echo ("<td> $row->Accepted");
   echo ("<form action=Student.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateAc' value = $row->id>");  
   echo ("Change Accepted <input type=text name='UpdatedAccepted'>");
   echo "</form>";
   echo ("<form action=Student.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=Student.php method=post>
<pre>
       New Student Info:
        Fname <input type=text name="Fname">
	Lname <input type=text name="Lname">
	Address_id <input type=text name="Address_id">
	Shirt_Size <input type=text name="Shirt_Size">
	School <input type=text name="School">
	Parent_id <input type=text name="Parent_id">
	Grade <input type=text name="Grade">
	Gender <input type=text name="Gender">
	Ethnicity <input type=text name="Ethnicity">
	Safe_PU <input type=text name="Safe_PU">
	No_PU <input type=text name="No_PU">
	Camp_id <input type=text name="Camp_id">
	Scholarship <input type=text name="Scholarship">
	Emerge_id <input type=text name="Emerge_id">
	Accepted <input type=text name="Accepted">
       <input type=submit value="Add Student">
<a href ="JoinedTable.php"> Student Table </a>
</pre>
</form>
<P>
<hr>
</html>
