<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Grant Information
<tr>
<td bgcolor=green>Fname
<td bgcolor=yellow>Update Fname
<td bgcolor=green>Lname
<td bgcolor=yellow>Update Lname
<td bgcolor=green>Amount
<td bgcolor=yellow>Update Amount
<td bgcolor=green>Email
<td bgcolor=yellow>Update Email
<td bgcolor=green>Phone
<td bgcolor=yellow>Update Phone
<td bgcolor=green>Address_id
<td bgcolor=yellow>Update Address_id
<td bgcolor=red>Delete

<?php
// connect the database
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysql_error());
   
   //If the form has data, then insert a new record
   if (isset($_POST['Fname']))
  {
   $Fname= $_POST['Fname'];
   $Lname = $_POST['Lname'];
   $Email= $_POST['Email'];
   $Phone= $_POST['Phone'];
   $Amount= $_POST['Amount'];
   $Address_id= $_POST['Address_id'];
   $query = "INSERT INTO Grant_info VALUES (NULL,'$Fname','$Lname','$Email','$Phone','$Amount','$Address_id')";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Grant_info WHERE id = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}
//change Fname of Grant_info if update was clicked and if post is not empty
elseif (isset($_POST['UpdateFN']))
{
	if(!empty($_POST['UpdatedFname']))
{
	$update = $_POST['UpdateFN'];
	$UpdateStreet= $_POST['UpdatedFname'];
	$query = "UPDATE Grant_info SET Fname = \"$UpdateFname\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedFname']))
{
	throw new InvalidArgumentException('Invalid Fname');
}
}
//change Lname of Grant_info if update was clicked and if post is not empty
elseif (isset($_POST['UpdateLN']))
{
	if(!empty($_POST['UpdatedLname']))
{
	$update = $_POST['UpdateLN'];
	$UpdateCity= $_POST['UpdatedLname'];
	$query = "UPDATE Grant_info SET Lname = \"$UpdateLname\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedLname']))
{
	throw new InvalidArgumentException('Invalid Lname');
}
}
//change Amount of Grant_info if update was clicked and if post is not empty
elseif (isset($_POST['UpdateA']))
{
	if(!empty($_POST['UpdatedAmount']))
{
	$update = $_POST['UpdateA'];
	$UpdateAmount= $_POST['UpdatedAmount'];
	$query = "UPDATE Grant_info SET Amount = \"$UpdateAmount\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedAmount']))
{
	throw new InvalidArgumentException('Invalid Amount');
}
}
//change Email of Grant_info if update was clicked and if post is not empty
elseif (isset($_POST['UpdateE']))
{
	if(!empty($_POST['UpdatedEmail']))
{
	$update = $_POST['UpdateE'];
	$UpdateState= $_POST['UpdatedEmail'];
	$query = "UPDATE Grant_info SET Email = \"$UpdateEmail\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedEmail']))
{
	throw new InvalidArgumentException('Invalid Email');
}
}
//change Phone of Grant_info if update was clicked and if post is not empty
elseif (isset($_POST['UpdateP']))
{
	if(!empty($_POST['UpdatedPhone']))
{
	$update = $_POST['UpdateP'];
	$UpdateZip = $_POST['UpdatedPhone'];
	$query = "UPDATE Grant_info SET Phone = $UpdateGrant_info WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedPhone']))
{
	throw new InvalidArgumentException('Invalid Phone');
}
}
elseif (isset($_POST['UpdateAID']))
{
	if(!empty($_POST['UpdatedAddress_id']))
{
	$update = $_POST['UpdateAID'];
	$UpdateAddress_id= $_POST['UpdatedAddress_id'];
	$query = "UPDATE Grant_info SET Address_id = \"$UpdateAddress_id\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedAddress_id']))
{
	throw new InvalidArgumentException('Invalid Address_id');
}
}
// submit and process the query for exisiting Grant_infos
$query = "select * from Grant_info;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Fname");
   echo ("<form action=crudtest.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateFN' value = $row->id>");  
   echo ("Change Fname <input type=text name='UpdatedFname'>");
   echo "</form>";
   echo("<td> $row->Lname");
   echo ("<form action=crudtest.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateLN' value = $row->id>");  
   echo ("Change Lname <input type=text name='UpdatedLname'>");
   echo "</form>";
   echo ("<td> $row->Email");
   echo ("<form action=crudtest.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateE' value = $row->id>");  
   echo ("Change Email <input type=text name='UpdatedEmail'>");
   echo "</form>";
   echo ("<form action=crudtest.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
   echo ("<td> $row->Amount");
   echo ("<form action=crudtest.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateA' value = $row->id>");  
   echo ("Change Amount <input type=text name='UpdatedAmount'>");
   echo "</form>";
   echo ("<td> $row->Address_id");
   echo ("<form action=crudtest.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateAID' value = $row->id>");  
   echo ("Change Address_id <input type=text name='UpdatedAddress_id'>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=crudtest.php method=post>
<pre>
		New Grant_info Info:
		Fname <input type=text name="Fname">
		Lname <input type=text name="Lname">
		Amount <input type=text name="Amount">
		Email <input type=text name="Email">
		Phone <input type=text name="Phone">
		Address_id <input type=text name="Address_id">
       <input type=submit value="Add Record">
<a href ="JoinedTable.php"> Addresses And Zips Table </a>
</pre>
</form>
<P>
<hr>
</html>
