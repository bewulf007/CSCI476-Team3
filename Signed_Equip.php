

<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>Id
<td bgcolor=green>Student_Id
<td bgcolor=yellow>Update Student_Id
<td bgcolor=green>Equip_Id
<td bgcolor=yellow>Update Equip_Id
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
   $Equip_id= mysqli_real_escape_string($DBconn, trim($_POST['Equip_id']));
   $query = "INSERT INTO Signed_Equip VALUES (Null,$Student_Id,$Equip_id)";
   $result = mysqli_query ($DBconn, $query);
  }
elseif (isset($_POST['remove']))
{
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Signed_Equip WHERE ID = \"$remove\"";
	$result = mysqli_query ($DBconn, $query);
}

//change Student_Id of Signed_Equip if update was clicked and if post is not empty
elseif (isset($_POST['UpdateT']))
{
	if(!empty($_POST['UpdatedStudent_Id']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateT']));
	$UpdateStudent_Id= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedStudent_Id']));
	$query = "UPDATE Signed_Equip SET Student_Id = \"$UpdateStudent_Id\" WHERE ID = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedStudent_Id']))
{
	throw new InvalIdArgumentException('InvalId Student_Id');
}

}

//change Student_Id of Signed_Equip if update was clicked and if post is not empty
elseif (isset($_POST['UpdateD']))
{
	if(!empty($_POST['UpdatedEquip_id']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateD']));
	$UpdateEquip_id= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedEquip_id']));
	$query = "UPDATE Signed_Equip SET Equip_id = $UpdateEquip_id WHERE ID = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedEquip_id']))
{
	throw new InvalIdArgumentException('InvalId Equip_id');
}

}

// submit and process the query for existing Students
$query = "select * from Signed_Equip;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->ID");
   echo("<td> $row->Student_Id");
   echo ("<form action=Signed_Equip.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hIdden' name ='UpdateT' value = $row->ID>");  
   echo ("Change Student_Id <input type=text name='UpdatedStudent_Id'>");
   echo "</form>";
   echo ("<td> $row->Equip_id");
   echo ("<form action=Signed_Equip.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hIdden' name ='UpdateD' value = $row->ID>");  
   echo ("Change Equip_id <input type=text name='UpdatedEquip_id'>");
   echo "</form>";
   echo ("<form action=Signed_Equip.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hIdden' name ='remove' value = $row->ID>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=Signed_Equip.php method=post>
<pre>
       New Signed_Equip:
	Student_Id <input type=text name="Student_Id">
	Equip_id <input type=text name="Equip_id">
       <input type=submit value="Add Record">
<a href ="JoinedTable.php"> Songs And Artists Table </a>
</pre>
</form>
<P>
<hr>
</html>

