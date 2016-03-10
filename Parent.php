//Will need a basic student info table(JOIN student w/ parent, camp, instructor
//Do Instructor & Equipment

<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>id
<td bgcolor=green>Street
<td bgcolor=yellow>Update Street

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
   $AddressID= $_POST['AddressID'];
   $Email= $_POST['Email'];
   $Phone= $_POST['Phone'];
   $query = "INSERT INTO Parent VALUES (NULL,'$Fname','$Lname',NULL,'$Email','$Phone')";//will need to adjust JOIN address to instructor
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Parent WHERE id = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}
//change Fname of Parent if update was clicked and if post is not empty
elseif (isset($_POST['UpdateFN']))
{
	if(!empty($_POST['UpdatedFname']))
{
	$update = $_POST['UpdateFN'];
	$UpdateStreet= $_POST['UpdatedFname'];
	$query = "UPDATE Parent SET Fname = \"$UpdateFname\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedFname']))
{
	throw new InvalidArgumentException('Invalid Fname');
}
}
//change Lname of Parent if update was clicked and if post is not empty
elseif (isset($_POST['UpdateLN']))
{
	if(!empty($_POST['UpdatedLname']))
{
	$update = $_POST['UpdateLN'];
	$UpdateCity= $_POST['UpdatedLname'];
	$query = "UPDATE Parent SET Lname = \"$UpdateLname\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedLname']))
{
	throw new InvalidArgumentException('Invalid Lname');
}
}
//change Email of Parent if update was clicked and if post is not empty
elseif (isset($_POST['UpdateE']))
{
	if(!empty($_POST['UpdatedEmail']))
{
	$update = $_POST['UpdateE'];
	$UpdateState= $_POST['UpdatedEmail'];
	$query = "UPDATE Parent SET Email = \"$UpdateEmail\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedEmail']))
{
	throw new InvalidArgumentException('Invalid Email');
}
}
//change Phone of Parent if update was clicked and if post is not empty
elseif (isset($_POST['UpdateP']))
{
	if(!empty($_POST['UpdatedPhone']))
{
	$update = $_POST['UpdateP'];
	$UpdateZip = $_POST['UpdatedPhone'];
	$query = "UPDATE Parent SET Phone = $UpdateParent WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedPhone']))
{
	throw new InvalidArgumentException('Invalid Phone');
}
}
