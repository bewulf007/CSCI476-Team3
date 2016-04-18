<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Allows Equipment to be Added to the Equipment Table -->
<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Equipment
<tr>
<td bgcolor=green>Id
<td bgcolor=green>Name
<td bgcolor=yellow>Update Name
<!--<td bgcolor=green>Student_id
<td bgcolor=yellow>Update Student_id-->
<td bgcolor=green>Serial_number
<td bgcolor=yellow>Update Serial_number
<td bgcolor=red>Delete

<?php
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysqli_error());
   
   //If the form has data, then insert a new record
   if (isset($_POST['Name']))
  {
   $Name= mysqli_real_escape_string($DBconn, trim($_POST['Name']));
   //$Student_id = $_POST['Student_id'];
   $Serial_number = mysqli_real_escape_string($DBconn, trim($_POST['Serial_number']));
   $query = "INSERT INTO Equipment VALUES (NULL,'$Name','$Serial_number')";
   $result = mysqli_query ($DBconn, $query);
  }
elseif (isset($_POST['remove']))
{
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Equipment WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query);
}
//change Name of Equipment if update was clicked and if post is not empty
elseif (isset($_POST['UpdateN']))
{
	if(!empty($_POST['UpdatedName']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateN']));
	$UpdateName= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedName']));
	$query = "UPDATE Equipment SET Name = \"$UpdateName\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedName']))
{
	throw new InvalidArgumentException('Invalid Name');
}
}
/*
//change Student_id of Equipment if update was clicked and if post is not empty
elseif (isset($_POST['UpdateSID']))
{
	if(!empty($_POST['UpdatedStudent_id']))
{
	$update = $_POST['UpdateSID'];
	$UpdateStudent_id= $_POST['UpdatedStudent_id'];
	$query = "UPDATE Equipment SET Student_id = \"$UpdateStudent_id\" WHERE id = $update;";
        $result = mysqli_query($query, $DBconn);
}
	if(empty($_POST['UpdatedStudent_id']))
{
	throw new InvalidArgumentException('Invalid Student_id');
}
}*/
//change Serial_number of Equipment if update was clicked and if post is not empty
elseif (isset($_POST['UpdateSN']))
{
	if(!empty($_POST['UpdatedSerial_number']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateSN']));
	$UpdateSerial_number= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedSerial_number']));
	$query = "UPDATE Equipment SET Serial_number = \"$UpdateSerial_number\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
}
	if(empty($_POST['UpdatedSerial_number']))
{
	throw new InvalidArgumentException('Invalid Serial_number');
}
}
// submit and process the query for exisiting Equipments
$query = "select * from Equipment;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Name");
   echo ("<form action=Equipment.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateN' value = $row->id>");  
   echo ("Change Name <input type=text name='UpdatedName'>");
   echo "</form>";
   /*echo("<td> $row->Student_id");
   echo ("<form action=Equipment.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateSID' value = $row->id>");  
   echo ("Change Student_id <input type=text name='UpdatedStudent_id'>");
   echo "</form>";*/
   echo("<td> $row->Serial_number");
   echo ("<form action=Equipment.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateSN' value = $row->id>");  
   echo ("Change Serial_number <input type=text name='UpdatedSerial_number'>");
   echo "</form>";
   echo ("<form action=Equipment.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=Equipment.php method=post>
<pre>
		New Equipment Info:
		Name <input type=text name="Name">
		Serial_number <input type=text name="Serial_number">
		<!--Student_id <input type=text name="Student_id">-->
       <input type=submit value="Add Record">
<a href ="Administrator.html"> Back To Administration </a>
</pre>
</form>
<P>
<hr>
</html>
