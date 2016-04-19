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

<?php
error_reporting(0);
if(!$file)
echo 'Please enter a valid file name: ';

//Requests a file name to send to readcsv.php
echo "<form action=\"readingcsv.php\" method=\"post\">
File Name: <input type=\"text\" name=\"file\"><br>
<input type=\"submit\" value=\"Accept\">";

if(isset($_POST['file']))
{
$file = $_POST['file'];

echo "<br><br>You entered:<br>" . $file;
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
