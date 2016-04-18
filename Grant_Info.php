<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Allows Information to be Added to the Grant_Info Table -->
<html>
<hr>
<!-- output table for crud -->
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Grant Information
<tr>
<td bgcolor=green>Id
<td bgcolor=green>First Name
<td bgcolor=yellow>Update First Name
<td bgcolor=green>Last Name
<td bgcolor=yellow>Update Last Name
<td bgcolor=green>Amount
<td bgcolor=yellow>Update Amount
<td bgcolor=green>Phone
<td bgcolor=yellow>Update Phone
<td bgcolor=green>Email
<td bgcolor=yellow>Update Email
<td bgcolor=red>Delete

<!--end of table -->

<?php //php begins here
// connect the database
$DBconn = mysqli_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysqli_select_db($DBconn, "my_morriss11");
if (!$db_selected)
//exception if cannot connect to database throw error message
   die ("Can't use my_morriss11 : " . mysqli_error());
   
   //If the form has data, then insert a new record
   if (isset($_POST['Fname']))
  {
//trim input to prevent sql injections
   $Fname= mysqli_real_escape_string($DBconn, trim($_POST['Fname']));
   $Lname = mysqli_real_escape_string($DBconn, trim($_POST['Lname']));
   $Amount= mysqli_real_escape_string($DBconn, trim($_POST['Amount']));
   $Phone= mysqli_real_escape_string($DBconn, trim($_POST['Phone']));
   $Email= mysqli_real_escape_string($DBconn, trim($_POST['Email']));
   $query = "INSERT INTO Grant_info VALUES (NULL,'$Fname','$Lname','$Amount','$Phone','$Email')";
   $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
  }
elseif (isset($_POST['remove']))
{
//if post remove is set delete the row with the id == remove
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Grant_info WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
//change Fname of Grant_info if update was clicked and if post is not empty
elseif (isset($_POST['UpdateFN']))
{
	if(!empty($_POST['UpdatedFname']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateFN']));
	$UpdateFname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedFname']));
	$query = "UPDATE Grant_info SET Fname = \"$UpdateFname\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedFname']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Fname');
}
}
//change Lname of Grant_info if update was clicked and if post is not empty
elseif (isset($_POST['UpdateLN']))
{
	if(!empty($_POST['UpdatedLname']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateLN']));
	$UpdateLname= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedLname']));
	$query = "UPDATE Grant_info SET Lname = \"$UpdateLname\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedLname']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Lname');
}
}
//change Amount of Grant_info if update was clicked and if post is not empty
elseif (isset($_POST['UpdateA']))
{
	if(!empty($_POST['UpdatedAmount']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateA']));
	$UpdateAmount= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedAmount']));
	$query = "UPDATE Grant_info SET Amount = \"$UpdateAmount\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedAmount']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Amount');
}
}
//change Phone of Grant_info if update was clicked and if post is not empty
elseif (isset($_POST['UpdateP']))
{
	if(!empty($_POST['UpdatedPhone']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateP']));
	$UpdatePhone = mysqli_real_escape_string($DBconn, trim($_POST['UpdatedPhone']));
	$query = "UPDATE Grant_info SET Phone = \"$UpdatePhone\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedPhone']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Phone');
}
}
//change Email of Grant_info if update was clicked and if post is not empty
elseif (isset($_POST['UpdateE']))
{
	if(!empty($_POST['UpdatedEmail']))
{
//trim input to prevent sql injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateE']));
	$UpdateEmail= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedEmail']));
	$query = "UPDATE Grant_info SET Email = \"$UpdateEmail\" WHERE id = $update;";
        $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
}
	if(empty($_POST['UpdatedEmail']))
{
//exception if the post is empty output error message
	throw new InvalidArgumentException('Invalid Email');
}
}
// submit and process the query for exisiting Grant_infos
$query = "select * from Grant_info;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   echo ("<tr> <td> $row->id");
   echo("<td> $row->Fname");
//form to post from textbox input to update Fname
   echo ("<form action=Grant_Info.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateFN' value = $row->id>");  
   echo ("Change Fname <input type=text name='UpdatedFname'>");
   echo "</form>";
//form to post from textbox input to update Lname
   echo("<td> $row->Lname");
   echo ("<form action=Grant_Info.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateLN' value = $row->id>");  
   echo ("Change Lname <input type=text name='UpdatedLname'>");
   echo "</form>";
//form to post from textbox input to update Amount
   echo ("<td> $row->Amount");
   echo ("<form action=Grant_Info.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateA' value = $row->id>");  
   echo ("Change Amount <input type=text name='UpdatedAmount'>");
   echo "</form>";
//form to post from textbox input to update Phone
   echo ("<td> $row->Phone");
   echo ("<form action=Grant_Info.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateP' value = $row->id>");  
   echo ("Change Phone <input type=text name='UpdatedPhone'>");
   echo "</form>";
//form to post from textbox input to update Email
   echo ("<td> $row->Email");
   echo ("<form action=Grant_Info.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateE' value = $row->id>");  
   echo ("Change Email <input type=text name='UpdatedEmail'>");
   echo "</form>";
//form to create the delete button to remove a row from the database and crud
   echo ("<form action=Grant_Info.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
}
//end of php
?>

</table>
<P>
<hr>
<P>

<form action=Grant_Info.php method=post>
<pre>
<!-- Textboxes to input a new record -->
		New Grant_info Info:
		Fname <input type=text name="Fname">
		Lname <input type=text name="Lname">
		Amount <input type=text name="Amount">
		Phone <input type=text name="Phone">
		Email <input type=text name="Email">
       <input type=submit value="Add Record">
<a href ="Administrator.html"> Back to Administrator Page </a>
</pre>
</form>
<P>
<hr>
</html>
