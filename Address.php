<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Allows Addresses to be Added to the Address Table -->

<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>id
<td bgcolor=green>Street
<td bgcolor=yellow>Update Street
<td bgcolor=green>City
<td bgcolor=yellow>Update City
<td bgcolor=green>State
<td bgcolor=yellow>Update State
<td bgcolor=green>Zip
<td bgcolor=yellow>Update Zip
<td bgcolor=red>Delete



<?php
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
if (!$db_selected)
   die ("Can't use my_morriss11 : " . mysqli_error());

// if the form has data, then insert a new record
if (isset($_POST['Street']))
  {
   $Street= mysqli_real_escape_string($DBconn, trim($_POST['Street']));
   $City = mysqli_real_escape_string($DBconn, trim($_POST['City']));
   $State= mysqli_real_escape_string($DBconn, trim($_POST['State']));
   $Zip= mysqli_real_escape_string($DBconn, trim($_POST['Zip']));
   $query = "INSERT INTO Address VALUES (NULL,'$Street','$City','$State','$Zip')";
   $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Address WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
//change street of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateS']))
{
	if(!empty($_POST['UpdatedStreet']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateS']));
	$UpdateStreet= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedStreet']));
	$query = "UPDATE Address SET Street = \"$UpdateStreet\" WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedStreet']))
{
	throw new InvalidArgumentException('Invalid Street');
}
}
//change city of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateC']))
{
	if(!empty($_POST['UpdatedCity']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateC']));
	$UpdateCity= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedCity']));
	$query = "UPDATE Address SET City = \"$UpdateCity\" WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedCity']))
{
	throw new InvalidArgumentException('Invalid City');
}
}
//change state of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateST']))
{
	if(!empty($_POST['UpdatedState']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateST']));
	$UpdateState= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedState']));
	$query = "UPDATE Address SET State = \"$UpdateState\" WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedState']))
{
	throw new InvalidArgumentException('Invalid State');
}
}
//change zip of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateZ']))
{
	if(!empty($_POST['UpdatedZip']))
{
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateZ']));
	$UpdateZip = mysqli_real_escape_string($DBconn, trim($_POST['UpdatedZip']));
	$query = "UPDATE Address SET Zip = $UpdateZip WHERE id = $update;";
    $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedZip']))
{
	throw new InvalidArgumentException('Invalid Zip');
}
}
// submit and process the query for existing Addresses
$query = "select * from Address;";
$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Street");
   echo ("<form action=Address.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateS' value = $row->id>");  
   echo ("Change Street <input type=text name='UpdatedStreet'>");
   echo "</form>";
   echo("<td> $row->City");
   echo ("<form action=Address.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateC' value = $row->id>");  
   echo ("Change City <input type=text name='UpdatedCity'>");
   echo "</form>";
   echo ("<td> $row->State");
   echo ("<form action=Address.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateST' value = $row->id>");  
   echo ("Change State <input type=text name='UpdatedState'>");
   echo "</form>";
   echo ("<td> $row->Zip");
   echo ("<form action=Address.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateZ' value = $row->id>");  
   echo ("Change Zip <input type=text name='UpdatedZip'>");
   echo "</form>";
   echo ("<form action=Address.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=Address.php method=post>
<pre>
       New Address Info:
        Street <input type=text name="Street">
	City <input type=text name="City">
	State <input type=text name="State">
	Zip <input type=text name="Zip">
       <input type=submit value="Add Record">
<a href ="Administrator.html"> Back To Administration </a>
</pre>
</form>
<P>
<hr>
</html>
