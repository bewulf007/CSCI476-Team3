<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=3 align=center><font color=white>Budget
<tr>
<td bgcolor=green>Budget
<td bgcolor=yellow>Update Budget
<td bgcolor=red>Delete Record


<?php
// connect the database
$DBconn = mysql_connect ("daytona.birdnest.org", "my.morriss11", "@y#mln52")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_morriss11", $DBconn);
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysql_error());

//If the form has data, then insert a new record
   if (isset($_POST['Budget']))
  {
   $Budget= $_POST['Budget'];

   $query = "INSERT INTO Budget VALUES (NULL,'$Budget')";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM Budget WHERE id = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}
//change Budget of Budget if update was clicked and if post is not empty
elseif (isset($_POST['UpdateB']))
{
	if(!empty($_POST['UpdatedBudget']))
	{
	$update = $_POST['UpdateB'];
	$UpdateBudget= $_POST['UpdatedBudget'];
	$query = "UPDATE Budget SET Budget = \"$UpdateBudget\" WHERE id = $update;";
        $result = mysql_query($query, $DBconn);
	}
	if(empty($_POST['UpdatedBudget']))
	{
	throw new InvalidArgumentException('Invalid Budget');
	}
}

// submit and process the query for existing Budget
$query = "select * from Budget;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   //echo ("<tr> <td> $row->id");
   echo("<tr><td> $row->Budget");

   echo ("<form action=Budget.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateB' value = $row->id>");  
   echo ("Change Budget <input type=text name='UpdatedBudget'>");
   echo "</form>";
   echo ("<form action=Budget.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
}
?>

</table>
<table rules=all border=10>
<tr>
<td bgcolor=white colspan=1 align=center><font color=black>
<?php
$query = "select SUM(Budget) AS Total from Budget;";
$result = mysql_query ($query, $DBconn);
$row = mysql_fetch_object ($result);
echo "Total: $" . $row->Total;
?>
</table>
<P>
<hr>
<P>
<form action=Budget.php method=post>
<pre>
		New Budget:
		Budget <input type=text name="Budget">
       <input type=submit value="Add Record">
<a href ="index.php"> Administrative Activities </a>
</pre>
</form>
<P>
<hr>
</html>
