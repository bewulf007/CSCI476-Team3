<?php
 session_start();
 if(!empty($_POST['username'])){
 $_SESSION['username'] = strtolower($_POST['username']);
 }
 if(!empty($_POST['password'])){
 $_SESSION['password'] = $_POST['password'];
 }

require("vendor/autoload.php");
use Adldap\Adldap;

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

try
{
    $ad = new Adldap($configuration);
} catch(AdldapException $e)
{
    echo "Uh oh, looks like we had an issue trying to connect: $e";
}
$authUser=false;
if(!empty($_POST['username']) && !empty($_POST['password']) && $_SESSION['username'] == "visitor" ){
$authUser = $ad->authenticate($_SESSION['username'], $_SESSION['password']);
}
if($authUser==true) { ?>
<!DOCTYPE html>
<html>
<head>
<style>
#header {
    background-color:#660000;
    color:white;
    text-align:center;
    padding:5px;
}

#section {
    width:350px;
    float:left;
    padding:4px;	 	 
}

</style>
</head>
<body>

<div id="header">
<h2 align=center>My Administrative activities</h3>
</div>


<h3 align=left>Read csv Files into Database</h3>
<a href ="readcsv.php">Read Registration Data </a>
<P>
<a href ="readingcsv.php">Read Scholarship Data </a>
<P>
<h3 align=left>Manage Information</h3>
<a href="Address.php">Addresses </a>
<P>
<a href="Camp.php">Camps</a>
<P>
<a href="Campers.php">Campers</a>
<P>
<a href="Emerge.php">Emergency Contacts</a>
<P>
<a href="Equipment.php">Equipment</a>
<P>
<a href ="Signed_Equip.php">Equipment Signed Out by Students </a>
<P>
<a href="Grant_Info.php">Grant Information</a>
<P>
<a href="Instructor.php">Instructors</a> 
<P>
<a href ="Student.php">Master List of Students</a>
<P>
<a href="Parent.php">Parents</a>
<P>
<a href ="Scholarship.php">Scholarships</a>
<P>
<a href ="waitlist.php">Waitlist</a>
<P>
 <a href="Budget.php">Budget</a>
</P>
<P>
<h3 align=left>Reports</h3>
<a href ="demographic_report.php">Demographic Report </a>
<P>
<a href ="GrantReport.php"> Grant Report </a>
<P>
<a href ="InstructorReport.php">Instructor Report  </a>
<P>
<a href ="EquipmentList.php"> List Of Camp Equipment </a>
<P>
<a href ="RollCall.php">Rollcall  </a>
<P>
<?php
}else{ ?>
<P>
<a href="admin.php">Password incorrect. Try again?</a>
</P>
<?php
}
?>
