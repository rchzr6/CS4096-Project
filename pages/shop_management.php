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
	
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php include '../includes/menu.php'; 
	$num = $res->num_rows;
	//echo $num;
	if($num > 0){
	
	Echo '<h1>Tasks:</h1><br>';
	echo '<a href="rev_assign_management.php">Review/Assign Work Orders</a><br>';
	echo '<a href="child_wo_start.php">Create/Manage Child Work Orders</a><br>';
	echo '<a href="reporting.php">Generate Reports</a><br>';
	echo '<a href="add_users.php">Add Users</a><br>';
	echo '<a href="remove_users.php">Remove Users</a>';
	}
	else {
	
	Echo '<h1>User not allowed to this area!</h1><br>';
	}
	
	 include '../includes/footer.php'; 
	
	?>
</body>
</html>