
<!DOCTYPE html>
<html>
<head>
<style>
#header {
    background-color:#660000;
    color:white;
    text-align:center;
    padding:25px;
    height:10%;
    width:96%;
}
#nav {
    line-height:30px;
    background-color:#660000;
    height:800px;
    width:224px;
    float:left;
    padding:20px;
    color: #660000;
}
#nav2 {
    line-height:30px;
    background-color:#660000;
    height:800px;
    width:224px;
    float:right;
    padding:20px;
    color: #660000;
}
#section {
    top:20px;
    bottom:0px;
    width:100%;
    height:100%;
    text-align:center;
    padding:0px;
    background-color:#FFCC33;
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
    height:5%;
    width:100%;
   padding:5px;	 	 
}
h1 {color:white;}
h2 {color:black;}
h3 {color:blue;}
h4 {color:#660000;}                 
h5 {color:red;}
</style>
</head>
<body>

<div id="header">
    <img id="stars_logo" src="stars_logo.png" alt="stars logo" align="left" height="100" width="112"/>
    <img id="wu_logo" src="wu_logo.png" alt="wu logo" align="right" height="100" width="120"/>
    <h1>Winthrop University Technology Camps</h1>

</div>

<div id="nav">
    <a href="main.html" style="color:black">Home</a><br>
    <a href="camps.html" style="color:black">Camps</a><br>
    <a href="staff.html" style="color:black">Staff</a><br>
    <a href="registration.html" style="color:black">Register</a><br>
    <a href="contact.html" style="color:black">Contact</a><br>    
    <a href="admin.html" style="color:black">Admin Login</a><br>
</div>

<div id="nav2"> 
</div>
<div id="section">

<p>Information about the camp</p>
<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>

</div>

<div
<?php 
    $dir = "/doman-project/*.png";
    //get the list of all files with .jpg extension in the directory and safe it in an array named $images
    $images = glob( $dir );
    
    //extract only the name of the file without the extension and save in an array named $find
    foreach( $images as $image )
    {
        echo "<img src='" . $image . "' />";
    }

?>
</div>

<div id="footer">
<center>Winthrop Technology Camps 2015 : http://birdnest.org/stars/computingcamp.htm</center>
</div>
</body>
</html>
