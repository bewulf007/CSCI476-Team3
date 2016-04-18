<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Allows Emerge to be Added to the Emerge Table -->
<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>Id
<td bgcolor=green>Fname
<td bgcolor=yellow>Update Fname
<td bgcolor=green>Lname
<td bgcolor=yellow>Update Lname
<td bgcolor=green>Email
<td bgcolor=yellow>Update Email
<td bgcolor=green>Phone
<td bgcolor=yellow>Update Phone
<td bgcolor=red>Delete



<?php
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysqli_error());

// if the form has data, then insert a new record
if (isset($_POST['Fname']))
  {
   $Fname= mysqli_real_escape_string($DBconn, trim($_POST['Fname']));
   $Lname = mysqli_real_escape_string($DBconn, trim($_POST['Lname']));
   $Email= mysqli_real_escape_string($DBconn, trim($_POST['Email']));
   $Phone= mysqli_real_escape_string($DBconn, trim($_POST['Phone']));
   $query = "INSERT INTO Emerge VALUES (NULL,'$Fname','$Lname','$Email','$Phone')";
   $result = mysqli_query ($DBconn, $query);
  }
elseif (isset($_POST['remove']))
{
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Emerge WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query);
}
//change fname of Emerge if update was clicked and if post is not empty
elseif (isset($_POST['UpdateF']))
{
	if(!empty($_POST['UpdatedFname']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateF']));
	$UpdateFname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedFname']));
	$query = "UPDATE Emerge SET Fname = \"$UpdateFname\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query);
}
	if(empty($_POST['UpdatedFname']))
{
	throw new InvalidArgumentException('Invalid Fname');
}
}
//change Lname of Emerge if update was clicked and if post is not empty
elseif (isset($_POST['UpdateL']))
{
	if(!empty($_POST['UpdatedLname']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateL']));
	$UpdateLname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedLname']));
	$query = "UPDATE Emerge SET Lname = \"$UpdateLname\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query);
}
	if(empty($_POST['UpdatedLname']))
{
	throw new InvalidArgumentException('Invalid Lname');
}
}
//change email of Emerge if update was clicked and if post is not empty
elseif (isset($_POST['UpdateE']))
{
	if(!empty($_POST['UpdatedEmail']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateE']));
	$UpdateEmail= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedEmail']));
	$query = "UPDATE Emerge SET Email = \"$UpdateEmail\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query);
}
	if(empty($_POST['UpdatedEmail']))
{
	throw new InvalidArgumentException('Invalid Email');
}
}
//change Phone of Emerge if update was clicked and if post is not empty
elseif (isset($_POST['UpdateP']))
{
	if(!empty($_POST['UpdatedPhone']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateP']));
	$UpdatePhone = mysqli_real_escape_string($DBconn, trim($_POST['UpdatedPhone']));
	$query = "UPDATE Emerge SET Phone = $UpdatePhone WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query);
}
	if(empty($_POST['UpdatedPhone']))
{
	throw new InvalidArgumentException('Invalid Phone');
}
}
// submit and process the query for existing Emergency contacts
$query = "select * from Emerge;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Fname");
   echo ("<form action=Emerge.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateF' value = $row->id>");  
   echo ("Change Fname <input type=text name='UpdatedFname'>");
   echo "</form>";
   echo("<td> $row->Lname");
   echo ("<form action=Emerge.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateL' value = $row->id>");  
   echo ("Change Lname <input type=text name='UpdatedLname'>");
   echo "</form>";
   echo ("<td> $row->Email");
   echo ("<form action=Emerge.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateE' value = $row->id>");  
   echo ("Change Email <input type=text name='UpdatedEmail'>");
   echo "</form>";
   echo ("<td> $row->Phone");
   echo ("<form action=Emerge.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateP' value = $row->id>");  
   echo ("Change Phone <input type=text name='UpdatedPhone'>");
   echo "</form>";
   echo ("<form action=Emerge.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=Emerge.php method=post>
<pre>
       New Emergency Contact Info:
        Fname <input type=text name="Fname">
	      Lname <input type=text name="Lname">
	      Email <input type=text name="Email">
	      Phone <input type=text name="Phone">
       <input type=submit value="Add Emergency Info">
<a href ="Administrator.html"> Back To Administration </a>
</pre>
</form>
<P>
<hr>
</html>
