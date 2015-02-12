<?php
	session_start();
//THIS PAGE HANDLES CHANGING A USER'S PASSWORD
//checking if a log SESSION VARIABLE has been set
include '../includes/connection.php';
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
        //if the user is not allowed, display a message and a link to go back to login page
	header("location:login.php");
        
        //then abort the script
	exit();
}
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<b>Change your workorder sytem password:</b><p>
	Enter your existing password and your new password.  While this password does not currently require any restrictions, please be aware
	that password security is still an issue, even in the workorder system.<p>
	<form id="Changepass" method="post" action="changepass.php" style="float:center;">

    <b><label for="old_pass">Current Password:</label></b><!----Gets Current Password to check---->
    <p><input type="password" name="old_pass" value=""></p>
    
    <b><label for="newpass_1">Password:</label></b><!----Gets New Password---->
    <p><input type="password" name="newpass_1" value=""></p>
    
    <b><label for="newpass_2">Repeat Password:</label></b><!----Gets New Password to check---->
    <p><input type="password" name="newpass_2" value=""></p>
    
    <p><button type="submit" name="go">Change Password</button></p>
</form>	
</body>
</html>