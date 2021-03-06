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
<?php
//Connect to the database
require_once ('connection.php');

$row = 1;

//Text box to enter a file name to be read into the database by the program
require_once ('file_readcsv.php');
$row = 0;
if($file)
if (($handle = fopen($file, "r")) !== FALSE) {
//read the file
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    $row++;

//We want to skip the first five rows on the csv as qualtrics provides unneeded information that we do not want inside of the database. Data to be read starts at row 5
if($row >=5)
{
//take the data and store the data into an array
    for ($c=0; $c < $num; $c++) {
	$data[$c];
}
/*these values will change based on updates to the survey Currently the data stored in the array goes as followed When the questions on qualtrics these values should be outputted to see how they have changed.
	$data[10] == Student Fname
	$data[11] == Student Lname
	$data[16] == Student Grade
	$data[17] == Student School
	$data[18] == Student Gender
	$data[19] == Student Ethnicity
	$data[21] == Student Shirt Size
	$data[22] == Parent Fname
	$data[23] == Parent Lname
	$data[24] == Parent Email
	$data[25] == Parent Phone
	$data[26] == Address: Street
	$data[27] == Address: City
	$data[28] == Address: State
	$data[29] == Address: Zip
	$data[30] == Student: Safe Pick Up 
	$data[31] == Student: No Pick Up
	$data[32] == Emergency Contact: FName
	$data[33] == Emergency Contact: Lname
	$data[34] == Emergency Contact: Email
	$data[35] == Emergency Contact: Phone
	$data[36] == Camp: Jewelry Camp
	$data[37] == Camp: Robotics Camp
	$data[38] == Camp: Mobile App Camp
	$data[39] == Camp: 3-D Printing	 
*/

//insert '$data[26]'(street),'$data[27]'(city),'$data[28]'(state),'$data[29]'(zip) into the database table Address
$query = "INSERT INTO Address VALUES (NULL,'$data[26]','$data[27]','$data[28]','$data[29]')";
$result = mysql_query ($query, $DBconn);


//Insert: '$data[32]'(First Name),'$data[33]'(Last Name),'$data[34]'(Email),'$data[35]'(Phone Number) into emergency contact table
$query1 = "INSERT INTO Emerge VALUES (NULL,'$data[32]','$data[33]','$data[34]','$data[35]')";
$result = mysql_query ($query1, $DBconn);


//search the address table for the address id where $data[26](street) exists
$query2 = "Select id From Address Where Street = '$data[26]'";
$result1 = mysql_query ($query2, $DBconn);
//if there is no result then print error
if (!$result1) {
	echo 'Error ID not found' . mysql_error();}
//store the id into the array $AddressId[0]
$AddressId = mysql_fetch_row($result1);

//insert: $data[22](Parent First Name),$data[23](Parent Last Name) ,$AddressId[0](Address Id),$data[24](Parent Email),$data[25] (Parent Phone Number)
$query = "INSERT INTO Parent VALUES (NULL,'$data[22]','$data[23]',$AddressId[0],'$data[24]','$data[25]')";
$result = mysql_query ($query, $DBconn);

//search the parent table for the parent id where $data[24](Email) exists
$query4 = "Select id From Parent Where Email = '$data[24]'";
$result2 = mysql_query ($query4, $DBconn);
//if there is no result then print error
if (!$result2) {
	echo 'Error ID not found' . mysql_error();}
//store the id into the array $ParentId[0]
$ParentId = mysql_fetch_row($result2);


//search the Emerge where data[34]
$query5 = "Select id From Emerge Where Email = '$data[34]'";
$result3 = mysql_query ($query5, $DBconn);
if (!$result3) {
	echo 'Error ID not found' . mysql_error();}
$EmergId = mysql_fetch_row($result3);


//insert: $data[10] (student first name),$data[11](student last name),$AddressId[0](address id from previous query),$data[21](shirt size),$data[17](school),$ParentId[0](Parent Id from previous query),$data[16](grade),'$data[18](gender),$data[19](ethnicity),$data[30](safe_pick up),$data[31](no pick up), $EmergId[0] (emergency contact id)
$query6 = "INSERT INTO Student VALUES (NULL,'$data[10]','$data[11]',$AddressId[0],'$data[21]','$data[17]',$ParentId[0],'$data[16]','$data[18]','$data[19]','$data[30]','$data[31]',$EmergId[0])";
$result = mysql_query ($query6, $DBconn);

//find id of student where first name == data from csv and last name == data from csv
$query7 = "Select id From Student Where Fname = '$data[10]' and Lname = '$data[11]'";
$result4 = mysql_query ($query7, $DBconn);
if (!$result4) {
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();}
$StudentId = mysql_fetch_row($result4);


//count the number of students with camp id of 1 to be used to check if camp is full or not
$query12 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=1";
$result9 = mysql_query ($query12, $DBconn);
if (!$result9) {
	echo 'Error ID not found' . mysql_error();}
$camp1count = mysql_fetch_row($result9);

//count the number of students with camp id of 2 to be used to check if camp is full or not
$query13 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=2";
$result10 = mysql_query ($query13, $DBconn);
if (!$result10) {
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();}
$camp2count = mysql_fetch_row($result10);

//count the number of students with camp id of 3 to be used to check if camp is full or not
$query14 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=3";
$result11 = mysql_query ($query14, $DBconn);
if (!$result11) {
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();}
$camp3count = mysql_fetch_row($result11);

//count the number of students with camp id of 4 to be used to check if camp is full or not
$query15 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=4";
$result12 = mysql_query ($query15, $DBconn);
if (!$result12) {
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();}
$camp4count = mysql_fetch_row($result12);

/*note that the following code will need to be updated with the new camp names every year
the camp name is hard coded so that you can search for the answer provided through qualtrics and check which answer or answers were chosen*/

//---------------------------JEWEL-----------------------------------------------------------

//if student chose the answer Computing and Jewelry Design Cost: $125 July 7 - 11 then check the count. Would recommend copy and pasted the answer from qualtrics to the next line of code
if ($data[36] == "Computing and Jewelry Design Cost: $125 July 7 - 11")
{
$query12 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=1";
$result9 = mysql_query ($query12, $DBconn);
}
if (!$result9) {
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();}
$camp1count = mysql_fetch_row($result9);

//if the count is less than 20 records and they chose Computing and Jewelry Design Cost: $125 July 7 - 11
if ($camp1count[0] < 20 and $data[36] == "Computing and Jewelry Design Cost: $125 July 7 - 11")
{
//then insert the student id with the camp value 1 for jewelry camp
$query8 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],1)";
$result5 = mysql_query ($query8, $DBconn);
}
$query30 = "Select ID From Campers where Student_Id = $StudentId[0] and Camp_Id = 1";
$result30 = mysql_query ($query30, $DBconn);
if (!$result30) 
{
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();
}
$Campers = mysql_fetch_row($result30);


if ($data[36] == "Computing and Jewelry Design Cost: $125 July 7 - 11"and $camp1count[0] >= 20 and $Campers[0] == NULL)
{
$query8 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],1)";
$result5 = mysql_query ($query8, $DBconn);
}


//----------------------------- ROBOT-----------------------------------------------------------

//if student chose the answer Computing and Robotics Cost $125 July 14 -18 then check the count.Would recommend copy and pasting the answer from qualtrics to the next line of code
if ($data[37] == "Computing and Robotics Cost $125 July 14 -18")
{
$query13 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=2";
$result10 = mysql_query ($query13, $DBconn);
}
if (!$result10) {
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();}
$camp2count = mysql_fetch_row($result10);

//then insert the student id with the camp value 2 for robotics camp
if ($camp2count[0] < 20 and $data[37] == "Computing and Robotics Cost $125 July 14 -18")
{
$query9 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],2)";
$result6 = mysql_query ($query9, $DBconn);
}
$query31 = "Select ID From Campers where Student_Id = $StudentId[0] and Camp_Id = 2";
$result31 = mysql_query ($query31, $DBconn);
if (!$result31) 
{
	echo 'Error ID not found' . mysql_error();
}
$Campers = mysql_fetch_row($result31);

//if the camp has more than 20 records then insert the record into the wait list 
if ($data[37] == "Computing and Robotics Cost $125 July 14 -18"and $camp2count[0] >= 20 and $Campers[0] == NULL)
{
$query9 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],2)";
$result6 = mysql_query ($query9, $DBconn);
}


//-----------------------------------Mobile-----------------------------------------------------

//if student chose the answer Computing Mobile Apps Cost: $125 July 21 - 25 then check the count.Would recommend copy and pasting the answers from qualtrics to the next line of code
if ($data[38] == "Computing Mobile Apps Cost: $125 July 21 - 25")
{
$query14 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=3";
$result11 = mysql_query ($query14, $DBconn);
}
if (!$result11) {
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();}
$camp3count = mysql_fetch_row($result11);

//then insert the student id with the camp value 3 for mobile app camp
if ($camp3count[0] < 20 and $data[38] == "Computing Mobile Apps Cost: $125 July 21 - 25")
{
$query10 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],3)";
$result7 = mysql_query ($query10, $DBconn);
}

//if the camp has more than 20 records then insert the record into the wait list 
$query32 = "Select ID From Campers where Student_Id = $StudentId[0] and Camp_Id = 3";
$result32 = mysql_query ($query32, $DBconn);
if (!$result32) 
{
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();
}
$Campers = mysql_fetch_row($result31);

if ($data[38] == "Computing Mobile Apps Cost: $125 July 21 - 25"and $camp3count[0] >= 20 and $Campers[0] == NULL)
{
$query10 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],3)";
$result7 = mysql_query ($query10, $DBconn);
}

//--------------------------------3-D-Print-----------------------------------------------------------

//if student chose the answer 3-D Printing Cost $125 then check the count. Would recommend copy and pasted the answers from qualtrics to the next line of code.
if ($data[39] == "3-D Printing Cost $125")
{
$query15 = "SELECT COUNT(Camp_Id) FROM Campers WHERE Camp_Id=4";
$result12 = mysql_query ($query15, $DBconn);
}
if (!$result12) {
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();}
$camp4count = mysql_fetch_row($result12);
if ($camp4count[0] < 20 and $data[39] == "3-D Printing Cost $125")
{
$query11 = "INSERT INTO Campers VALUES (NULL,$StudentId[0],4)";
$result8 = mysql_query ($query11, $DBconn);
}

//then insert the student id with the camp value 4 for 3-D Printing camp
$query33 = "Select ID From Campers where Student_Id = $StudentId[0] and Camp_Id = 4";
$result33 = mysql_query ($query33, $DBconn);
if (!$result33) 
{
//if results dont exist print error message
	echo 'Error ID not found' . mysql_error();
}
$Campers = mysql_fetch_row($result31);

//if the camp has more than 20 records then insert the record into the wait list 
if ($data[39] == "3-D Printing Cost $125"and $camp4count[0] >= 20 and $Campers[0] == NULL)
{
$query11 = "INSERT INTO Waitlist VALUES (NULL,$StudentId[0],4)";
$result8 = mysql_query ($query11, $DBconn);
}

}}
//close the file
  fclose($handle);
echo "<P>";
echo 'File has been read';
}
?>
<?php
}else{ ?>
<P>
<a href="admin.php">Password incorrect. Try again?</a>
</P>
<?php
}
?>

