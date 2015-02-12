<?php
	session_start();
//THIS PAGE IS THE MANAGEMENT "HUB", GIVES MANAGEMENT OPTIONS ON WHAT THEY CAN DO 
//checking if a log SESSION VARIABLE has been set
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'in') ){
        //if the user is not allowed, display a message and a link to go back to login page
	header("location:login.php");
        
       // then abort the script
	exit();
}
$notallowed=1;
include '../includes/connection.php';//File to get the connection to the databases for queries
$user = $_SESSION['username'];//gets session variable username
$q = "SELECT `id` FROM `member` WHERE `username` = '$user'";//gets user's id from the member table where their login info is stored
	$resid = mysqli_query($con,$q);
	
	$row = $resid->fetch_assoc();
    $id = $row['id'];
    
	$q = "SELECT `name` FROM  `staff` WHERE `id_num` = '$id'";//checks if user is staff
	$res = mysqli_query($con,$q);
	$myname="";
	$numb = $res->num_rows;
	if($numb >0){
		$row = $res->fetch_assoc();
		$myname = $row['name'];
	}
	//echo $myname;
	$q = "SELECT * FROM  `group` WHERE `user_name` = '$myname' AND `role` = 'Manager'";//checks if user is in the groups table and gets that info
	$res = mysqli_query($con,$q);
	$num = $res->num_rows;
	//echo $num;
	if($num == 0){
		header("location:../index.php?log=in#");
        
       // then abort the script
		exit();
	}

include '../includes/connection.php';
if(isset($_POST['Submit'])){//checks to see if form has been submitted, if yes, stores the info in php variables for use
	include '../includes/queries/add_user_queries.php';//includes the file that stores the info and then uses the info the run the queries
}
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css"><!--Refrences the CSS style sheet held in the base CSS folder--->
</head>
<body>
	<?php include '../includes/menu.php'; //Includes the normal main menu ?>
	<h1>Management Add Users</h1>
	<form id="add_users" action="#" method="post"><!----adds the form to get the user info to store----->
		<b>First Name</b>: <input type="text" name="fname"></input><br>
		<b>Last Name</b>: <input type="test" name="lname"></input><br>
		<b>Username</b>: <input type="text" name="user"></input><br>
		<b>MST Email</b>: <input type="text" name="id"></input></br>
		<b>Password</b>: <input type="text" name="password"></input><br>
		<b>Type</b>: <select form="add_users" name="type" >
			<option value="faculty">Faculty</option>
			<option value="staff">Staff</option>
		</select><br>
		<b>Room Number</b>: 	<input type="text" name="room"></input><br>
		<b>Phone Number</b>: <input type="text" name="phone"></input><br>
		<b>Group</b>: 
		<select form="add_users" name="worktype">
			<option value="Mechanical">Mechanical</option>
			<option value="Electrical/Electronic">Electrical/Electronic</option>
			<option value="Moving/Labor">Moving/Labor</option>
			<option value="Rapid Prototype">Rapid Prototype</option>
			<option value="Other">Other</option>
		</select> Ignore for Faculty<br> 
		<b>Role</b>:
		<select form='add_users' name="role">
			<option value="Manager">Manager</option>
			<option value="Member">Member</option>
		</select> Ignore for Faculty<br>
		<input type="submit" value="Submit" name="Submit"/>
	</form>
	
	<?php include '../includes/footer.php'; ?><!---ADDS THE BASIC FOOTER TO THE PAGE--->
</body>
</html>