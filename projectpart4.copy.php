<!-- Matthew Paterno -->
<!-- Database Program -->
<!-- Allows Records to be Added to the ARTIST Table -->
<!-- Contains one form that is also processed by this script -->

<html>
<hr>
<table rules=all border=10>
<tr>
<td bgcolor=black colspan=8 align=center><font color=white>Existing Users
<tr>
<td bgcolor=green>SongID
<td bgcolor=green>Title
<td bgcolor=yellow>Update Title
<td bgcolor=green>Duration
<td bgcolor=yellow>Update Duration
<td bgcolor=green>Artist
<td bgcolor=yellow>Update Artist
<td bgcolor=red>Delete



<?php
// connect the database
$DBconn = mysql_connect ("daytona.birdnest.org", "my.paternom3", "d9e3x28ht")
          or exit ("failed to connect to mysql");
$db_selected = mysql_select_db("my_paternom3", $DBconn);
if (!$db_selected)
   die ("Can't use my_paternom3 : " . mysql_error());

// if the form had data, then insert a new record
if (isset($_POST['Title']))
  {

   $Title = $_POST['Title'];
   $Duration= $_POST['Duration'];
   $Artist= $_POST['Artist'];
   $query = "INSERT INTO SONG VALUES (NULL,'$Title',$Duration,$Artist)";
   $result = mysql_query ($query, $DBconn);
  }
elseif (isset($_POST['remove']))
{
	$remove = $_POST['remove'];
	$query = "DELETE FROM SONG WHERE SongID = \"$remove\"";
	$result = mysql_query ($query, $DBconn);
}
//change title of song if update was clicked and if post is not empty
elseif (isset($_POST['UpdateT']))
{
	if(!empty($_POST['UpdatedTitle']))
{
	$update = $_POST['UpdateT'];
	$UpdateTitle= $_POST['UpdatedTitle'];
	$query = "UPDATE SONG SET Title = \"$UpdateTitle\" WHERE SongID = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedTitle']))
{
	throw new InvalidArgumentException('Invalid Title');
}

}
//change title of duration if update was clicked and if post is not empty
elseif (isset($_POST['UpdateD']))
{
	if(!empty($_POST['UpdatedDuration']))
{
	$update = $_POST['UpdateD'];
	$UpdateDuration= $_POST['UpdatedDuration'];
	$query = "UPDATE SONG SET Duration = $UpdateDuration WHERE SongID = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedDuration']))
{
	throw new InvalidArgumentException('Invalid Duration');
}

}
//change title of artist if update was clicked and if post is not empty
elseif (isset($_POST['UpdateA']))
{
	if(!empty($_POST['UpdatedArtist']))
{
	$update = $_POST['UpdateA'];
	$UpdateArtist = $_POST['UpdatedArtist'];
	$query = "UPDATE SONG SET Artist = $UpdateArtist WHERE SongID = $update;";
        $result = mysql_query($query, $DBconn);
}
	if(empty($_POST['UpdatedArtist']))
{
	throw new InvalidArgumentException('Invalid Artist');
}
}
// submit and process the query for existing Artists
$query = "select * from SONG;";
$result = mysql_query ($query, $DBconn);
while ($row = mysql_fetch_object ($result))
{
   echo ("<tr> <td> $row->SongID");
   echo("<td> $row->Title");
   echo ("<form action=projectpart4.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateT' value = $row->SongID>");  
   echo ("Change Title <input type=text name='UpdatedTitle'>");
   echo "</form>";
   echo ("<td> $row->Duration");
   echo ("<form action=projectpart4.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateD' value = $row->SongID>");  
   echo ("Change Duration <input type=text name='UpdatedDuration'>");
   echo "</form>";
   echo ("<td> $row->Artist");
   echo ("<form action=projectpart4.php method = post>");
   echo ("<td> <input type=submit value=Update>");
   echo ("<input type='hidden' name ='UpdateA' value = $row->SongID>");  
   echo ("Change Artist <input type=text name='UpdatedArtist'>");
   echo "</form>";
   echo ("<form action=projectpart4.php method =post>");
   echo ("<td> <input type=submit value=Delete>");
   echo ("<input type='hidden' name ='remove' value = $row->SongID>");
   echo "</form>";
}
?>

</table>
<P>
<hr>
<P>

<form action=projectpart4.php method=post>
<pre>
       New Song Info:
	Title <input type=text name="Title">
	Duration <input type=text name="Duration">
	Artist <input type=text name="Artist">
       <input type=submit value="Add Record">
<a href ="JoinedTable.php"> Songs And Artists Table </a>
</pre>
</form>
<P>
<hr>
</html>
