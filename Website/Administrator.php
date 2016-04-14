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
<h2 align=center>My Administrative activities</h3>

<a href="Address.php">Address CRUD </a>
<P>
<a href="Camp.php">Camp CRUD</a>
<P>
<a href="Campers.php">Campers CRUD</a>
<P>
<a href="Budget.php">Budget CRUD Form </a>
<P>
<a href="Emerge.php">Emergency Contacts CRUD Form</a>
<P>
<a href="Equipment.php">Equipment CRUD Form </a>
<P>
<a href="Instructor.php">Instructor CRUD Print </a> - Add/Remove Instructors Here
<P>
<a href="Parent.php">Parent CRUD search </a>
<P>
<a href ="Scholarship.php">Scholarship CRUD </a>
<P>
<a href ="Student.php">Student CRUD </a>
<P>
<a href ="waitlist.php">Waitlist CRUD </a>
<P>
<a href ="readcsv.php">Read Registration data </a>
<P>
<a href ="readingcsv.php">Read scholarship data </a>
<P>
<a href ="EquipmentList.php"> List Of Camp Equipment </a> Printable List of Equipment for Camps
<P>
<a href ="GrantReport.php"> Grant Report </a> - Printable list of Grant information
<P>
<a href ="InstructorReport.php">Instructor Report  </a> - Printable list of instructors and camps
<P>
<a href ="RollCall.php">Camper Report  </a> - Printable List for Roll Calls
<P>
<a href ="Report.php">Report </a> - All Information for report
<?php
}else{ ?>
<P>
<a href="admin.php">Password incorrect. Try again?</a>
</P>
<?php
}
?>
