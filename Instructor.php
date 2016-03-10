//Will need a basic student info table(JOIN student w/ parent, camp, instructor

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
   $query = "INSERT INTO Address VALUES (NULL,'$Fname','$Lname',NULL,'$Email','$Phone')";//will need to adjust JOIN address to instructor
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Address WHERE id = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}
//change Fname of Student if update was clicked and if post is not empty
elseif (isset($_POST['UpdateFN']))
{
	if(!empty($_POST['UpdatedFname']))
{
	$update = $_POST['UpdateFN'];
	$UpdateStreet= $_POST['UpdatedFname'];
	$query = "UPDATE Student SET Fname = \"$UpdateFname\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedFname']))
{
	throw new InvalidArgumentException('Invalid Fname');
}
}
//change city of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateC']))
{
	if(!empty($_POST['UpdatedCity']))
{
	$update = $_POST['UpdateC'];
	$UpdateCity= $_POST['UpdatedCity'];
	$query = "UPDATE Address SET City = \"$UpdateCity\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedCity']))
{
	throw new InvalidArgumentException('Invalid City');
}
}
//change title of duration if update was clicked and if post is not empty
elseif (isset($_POST['UpdateS']))
{
	if(!empty($_POST['UpdatedState']))
{
	$update = $_POST['UpdateS'];
	$UpdateState= $_POST['UpdatedState'];
	$query = "UPDATE Address SET State = \"$UpdateState\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedState']))
{
	throw new InvalidArgumentException('Invalid Duration');
}
}
//change title of artist if update was clicked and if post is not empty
elseif (isset($_POST['UpdateZ']))
{
	if(!empty($_POST['UpdatedZip']))
{
	$update = $_POST['UpdateZ'];
	$UpdateZip = $_POST['UpdatedZip'];
	$query = "UPDATE Address SET Zip = $UpdateZip WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedZip']))
{
	throw new InvalidArgumentException('Invalid Zip');
}
}
