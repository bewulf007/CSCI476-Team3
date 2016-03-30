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
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysql_error());

// if the form has data, then insert a new record
if (isset($_POST['Street']))
  {
   $Street= $_POST['Street'];
   $City = $_POST['City'];
   $State= $_POST['State'];
   $Zip= $_POST['Zip'];
   $query = "INSERT INTO Address VALUES (NULL,'$Street','$City','$State','$Zip')";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Address WHERE id = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}

//change street of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateS']))
{
	if(!empty($_POST['UpdatedStreet']))
{
	$update = $_POST['UpdateS'];
	$UpdateStreet= $_POST['UpdatedStreet'];
	$query = "UPDATE Address SET Street = \"$UpdateStreet\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
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

//change state of address if update was clicked and if post is not empty
elseif (isset($_POST['UpdateST']))
{
	if(!empty($_POST['UpdatedState']))
{
	$update = $_POST['UpdateST'];
	$UpdateState= $_POST['UpdatedState'];
	$query = "UPDATE Address SET State = \"$UpdateState\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
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

// submit and process the query for existing Addresses
$query = "select * from Address;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
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
<a href ="JoinedTable.php"> Addresses And Zips Table </a>
</pre>
</form>
<P>
<hr>
</html>
