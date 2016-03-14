<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>id
<td bgcolor=green>Fname
<td bgcolor=yellow>Update Fname
<td bgcolor=green>Lname
<td bgcolor=yellow>Update Lname
<td bgcolor=green>email
<td bgcolor=yellow>Update email
<td bgcolor=green>phone
<td bgcolor=yellow>Update phone
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
   $email= $_POST['email'];
   $phone= $_POST['phone'];
   $query = "INSERT INTO Emerge VALUES (NULL,'$Fname','$Lname','$email','$phone')";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Emerge WHERE id = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}
//change fname of Emerge if update was clicked and if post is not empty
elseif (isset($_POST['UpdateF']))
{
	if(!empty($_POST['UpdatedFname']))
{
	$update = $_POST['UpdateF'];
	$UpdateFname= $_POST['UpdatedFname'];
	$query = "UPDATE Emerge SET Fname = \"$UpdateFname\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
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
	$update = $_POST['UpdateL'];
	$UpdateLname= $_POST['UpdatedLname'];
	$query = "UPDATE Emerge SET Lname = \"$UpdateLname\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedLname']))
{
	throw new InvalidArgumentException('Invalid Lname');
}
}
//change title of duration if update was clicked and if post is not empty
elseif (isset($_POST['UpdateE']))
{
	if(!empty($_POST['UpdatedEmail']))
{
	$update = $_POST['UpdateE'];
	$UpdateEmail= $_POST['UpdatedEmail'];
	$query = "UPDATE Emerge SET email = \"$UpdateEmail\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedEmail']))
{
	throw new InvalidArgumentException('Invalid Email');
}
}
//change phone of emergency if update was clicked and if post is not empty
elseif (isset($_POST['UpdateP']))
{
	if(!empty($_POST['UpdatedPhone']))
{
	$update = $_POST['UpdateP'];
	$UpdatePhone = $_POST['UpdatedPhone'];
	$query = "UPDATE Emerge SET phone = $UpdatePhone WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedPhone']))
{
	throw new InvalidArgumentException('Invalid Phone');
}
}
// submit and process the query for existing Artists
$query = "select * from Emerge;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
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
   echo ("<td> $row->email");
   echo ("<form action=Emerge.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateE' value = $row->id>");  
   echo ("Change Email <input type=text name='UpdatedEmail'>");
   echo "</form>";
   echo ("<td> $row->phone");
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
	      email <input type=text name="email">
	      phone <input type=text name="phone">
       <input type=submit value="Add Emergency Info">
<a href ="JoinedTable.php"> Emergency Contact Table </a>
</pre>
</form>
<P>
<hr>
</html>
