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
	$id = (mysqli_field_seek($resid,0));
	$q = "SELECT `name` FROM  `staff` WHERE `id_num` = '$id'";//checks if user is staff
	$res = mysqli_query($con,$q);
	$myname="";
	if(mysqli_num_rows($res) >0)
		$myname = mysqli_field_seek($res,0);
	$q = "SELECT * FROM  `group` WHERE `user_name` = '$myname' AND `role` = 'Manager'";//checks if user is in the groups table and gets that info
	$res = mysqli_query($con,$q);
	$num = $res->num_rows;
	//echo $num;
	if($num == 0){
		header("location:../index.php?log=in#");
        
       // then abort the script
		exit();
	}
	
?>
<html>
<head>
	 <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<?php include '../includes/menu.php'; 
	//if(mysqli_num_rows($res) >0){
	
	Echo '<h1>Tasks:</h1><br>';
	echo '<a href="../includes/reports/report_wos_1.php">Work Order Status</a><br>';
	echo '<a href="../includes/reports/report_staff_1.php">Staff Work Orders</a><br>';
	echo '<a href="../includes/reports/report_staff_daily_1.php">Staff Hours Worked By Day</a><br>';

	// }
	// else {
	
	// Echo '<h1>User not allowed to this area!</h1><br>';
	// }
	
	 include '../includes/footer.php'; 
	
	?>
</body>
</html>