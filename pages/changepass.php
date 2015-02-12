<?php
//THIS PAGE processes the change password functions
session_start();

//checking if a log SESSION VARIABLE has been set
echo "Password changer<br>";
$user = $_SESSION['username'];
//if( !isset($_SESSION['log']) {
       	
{	

		function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 //gets the submitted info and stores it in the appropriate variables
$old_pass = $_POST["old_pass"];
$newpass_1 = $_POST["newpass_1"];
$newpass_2 = $_POST["newpass_2"];

	//checks for common errors and creates the appropriate error messages
	if (empty ($old_pass)){
		died ('Old password empty :Please fill out all fields before submitting the form');
	}
	if (empty ($newpass_1)){
		died ('New password empty : Please fill out all fields before submitting the form');
	}
	if (empty ($newpass_2)){
		died ('Repeated password empty: Please fill out all fields before submitting the form');
	}
	if ($newpass_1 <> $newpass_2){
		died ('Passwords to not match.  Both new password entries must be the same.');
	}
	
	include '../includes/connection.php';//File to get the connection to the databases for queries
	
	$hashpass = SHA1($old_pass);//hases the old password for comparison to the value in the db
	$q = "SELECT `password` FROM `member` WHERE username='".$user."'";//queries the db and gets the current password
	$res = mysqli_query($con,$q);
	$resar = $row = $res->fetch_assoc();;
	$p=$resar['password'];
	//checks to see if the passwords match and if not creates an error
	If ($p <> $hashpass){
		died ('The old password you entered does not match the password on file....  Process Terminated.');
	}
	$hashpass = SHA1($newpass_1);//hases the new password and then enters it into the database
	$q= "UPDATE member SET password='".$hashpass."'WHERE username='".$user."'";
	$res = mysqli_query($con,$q);
	Echo "<br><br><br>Password updated!";


}	




?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css"><!----includes the CSS Style sheet.---->
</head>

<body>
	
</body>
</html>