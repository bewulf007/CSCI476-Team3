<?php
//The security ties in with LDAP using session variables, initialize the session:
session_start();

//LDAP requires/namespaces
require("vendor/autoload.php");
use Adldap\Adldap;

//Declares the Adldap array pointed at Winthrop's auth. server
$configuration = array(
    'account_suffix' => '@winthrop.edu',
    'domain_controllers' => array("rahway.winthrop.edu"),
    'base_dn' => 'DC=win, DC=winthrop, DC=edu',
    'real_primarygroup' => true,
    'use_ssl' => false,
    'recursive_groups' => true,
    'ad_port' => '636',
    'sso' => false,
);
//Uses built-in error handling to detect issues connecting
try
{
    $ad = new Adldap($configuration);
} catch(AdldapException $e)
{
    echo "Uh oh, looks like we had an issue trying to connect: $e";
}

//Default to false, assume auth failed unless proven otherwise
$authUser=false;
if($_SESSION['username'] == "visitor" ){
//Authentication status depends on success/failure of submission, using session authentications
$authUser = $ad->authenticate($_SESSION['username'], $_SESSION['password']);
}
//if we succeeded, render the admin page:
if($authUser==true) { ?>
<!-- Summer Camp Project -->
<!-- Database Program -->
<!-- Allows Budgets to be Added to the Budgets Table -->

<html>
<hr>
<P>
<form action=Budget.php method=post>
<pre>
<!-- Textboxes to input a new record -->
                New Budget:
                Budget <input type=text name="Budget">
       <input type=submit value="Add Record">

<table rules=all border=10>
<tr>
<td bgcolor=black colspan=3 align=center><font color=white>Budget
<tr>
<td bgcolor=green>Budget
<td bgcolor=yellow>Update Budget
<td bgcolor=red>Delete Record


<?php //php begins here
// connect the database
require_once ('connection.php');

//If the form has data, then insert a new record
   if (isset($_POST['Budget']))
  {
   $Budget= mysqli_real_escape_string($DBconn, trim($_POST['Budget']));
   if(is_numeric($Budget))
   {
   $query = "INSERT INTO Budget VALUES (NULL,'$Budget')";
   $result = mysqli_query ($DBconn, $query) or die ('Error querying database.');
   }
  }

elseif (isset($_POST['remove']))
{
//trim all input to prevent SQL injections
	$remove = mysqli_real_escape_string($DBconn, trim($_POST['remove']));
	$query = "DELETE FROM Budget WHERE id = \"$remove\"";
	$result = mysqli_query ($DBconn, $query);
}
//change Budget of Budget if update was clicked and if post is not empty
elseif (isset($_POST['UpdateB']))
{
	if(!empty($_POST['UpdatedBudget']))
	{
//trim all input to prevent SQL injections
	$update = mysqli_real_escape_string($DBconn, trim($_POST['UpdateB']));
	$UpdateBudget= mysqli_real_escape_string($DBconn, trim($_POST['UpdatedBudget']));
	$query = "UPDATE Budget SET Budget = \"$UpdateBudget\" WHERE id = $update;";
        $result = mysqli_query($DBconn, $query);
	}
//exception if post is empty output error message
	if(empty($_POST['UpdatedBudget']))
	{
	throw new InvalidArgumentException('Invalid Budget');
	}
}

// submit and process the query for existing Budget
$query = "select * from Budget;";
$result = mysqli_query ($DBconn, $query);
while ($row = mysqli_fetch_object ($result))
{
   //echo ("<tr> <td> $row->id");
   echo("<tr><td> $row->Budget");
//form to post from textbox input to update Budget
   echo ("<form action=Budget.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateB' value = $row->id>");  
   echo ("Change Budget <input type=text name='UpdatedBudget'>");
   echo "</form>";
//form to create the delete button to remove a row from the database and crud
   echo ("<form action=Budget.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->id>");
   echo "</form>";
}
//end of php
?>

</table>
<table rules=all border=10>
<tr>
<td bgcolor=white colspan=1 align=center><font color=black>
<?php
$query = "select SUM(Budget) AS Total from Budget;";
$result = mysqli_query ($DBconn, $query);
$row = mysqli_fetch_object ($result);
echo "Total: $" . $row->Total;
?>
</table>
<P>
<hr>
<P>
<a href ="Administrator.php"> Back To Administration </a>
</pre>
</form>
<P>
<hr>
</html>
<?php
}else{ ?>
<P>
<a href="admin.php">Password incorrect. Try again?</a>
</P>
<?php
}
?>

