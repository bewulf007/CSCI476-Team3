<!DOCTYPE html>
<?php session_start() ?>
<html>
<head>
<title>Administration Login</title>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="stylesheet" type="text/css" href="../css/12884.css" />
</head>
<body>
    <div id="wrapper">
        <div id="headerwrap">
        <div id="header">
            <img id="stars_logo" src="../img/stars_logo.png" alt="stars logo" align="left" height="90" width="120"/>
            <img id="wu_logo" src="../img/wu_logo.png" alt="wu logo" align="right" height="90" width="120"/>
            <h1>Winthrop University<br> Summer Computing Camps 2016</h1>
        </div>
        </div>
        <div id="leftcolumnwrap">
        <div id="leftcolumn">
            <a href="home.htm" style="color:black">Home</a><br><br>
            <a href="camps.html" style="color:black">Camps</a><br><br>
            <a href="staff.html" style="color:black">Staff</a><br><br>
            <a href="registration.html" style="color:black">Register</a><br><br>
            <a href="contact.html" style="color:black">Contact</a><br>  <br>  
            <a href="admin.php" style="color:black">Admin Login</a><br><br>
            <br>
            <br>
            <br>
        </div>
        </div>
        <div id="contentwrap">
        <div id="content">
           <h2>Administration Login</h2><br>
              <form method="post" action="Administrator.php">
     
                    Username: <input type="text" name="username" value="" >
                    <p></p>
                    Password: <input type="password" name="password" value="" >
                    <p></p>
            	    
                  
                    <button id="login">Login</button>
                    <p> </p>
       
      </form>
        </div>
        </div>
        <div id="footerwrap">
        <div id="footer">
            <p>Winthrop Technology Camps 2016 : http://birdnest.org/stars/computingcamp.htm</p>
        </div>
        </div>
    </div>
</body>
</html>
